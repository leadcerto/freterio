<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

class ImageController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $images = $user->isAdmin()
            ? Image::with('user')->latest()->paginate(20)
            : Image::where('user_id', $user->id)->latest()->paginate(20);

        return view('admin.images.index', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|file|mimes:jpg,jpeg,png,gif,webp|max:153600',
            'type'  => 'required|in:destaque,frota,whatsapp,veiculo_1,veiculo_2,veiculo_3,veiculo_4,veiculo_5',
        ], [
            'image.required' => 'Selecione uma imagem antes de enviar.',
            'image.file'     => 'O arquivo enviado é inválido.',
            'image.mimes'    => 'Apenas JPG, JPEG, PNG, GIF ou WebP são aceitos.',
            'image.max'      => 'A imagem não pode ultrapassar 150MB.',
            'type.required'  => 'Selecione o tipo da imagem.',
        ]);

        try {
            $file    = $request->file('image');
            $manager = new ImageManager(new Driver());

            // v4: usa decode() em vez de read()
            $img = $manager->decode($file->getRealPath());

            // Redimensiona apenas se a largura ultrapassar 1920px
            if ($img->width() > 1920) {
                $img->scale(width: 1920);
            }

            // Mantém o nome original do arquivo, troca extensão para .webp e sanitiza
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $baseName     = \Illuminate\Support\Str::slug($originalName);
            $baseName     = $baseName ?: uniqid('img');

            // Garante nome único se já existir arquivo com o mesmo nome
            $filename = $baseName . '.webp';
            $counter  = 1;
            while (Storage::disk('public')->exists('images/' . $filename)) {
                $filename = $baseName . '-' . $counter . '.webp';
                $counter++;
            }

            $path = 'images/' . $filename;

            // v4: usa encode() com WebpEncoder — qualidade alta para preservar detalhes
            $encoded = $img->encode(new WebpEncoder(quality: 95));

            Storage::disk('public')->makeDirectory('images');
            Storage::disk('public')->put($path, (string) $encoded);

            Image::create([
                'user_id'   => auth()->id(),
                'type'      => $request->type,
                'filename'  => $filename,
                'path'      => $path,
                'is_active' => true,
            ]);

            return back()->with('success', 'Imagem enviada e convertida para WebP com sucesso!');

        } catch (\Throwable $e) {
            Log::error('Erro no upload de imagem: ' . $e->getMessage());
            return back()->withErrors(['image' => 'Erro ao processar a imagem: ' . $e->getMessage()]);
        }
    }

    public function updateType(Request $request, Image $image)
    {
        $this->authorizeImage($image);
        $request->validate([
            'type' => 'required|in:destaque,frota,whatsapp,veiculo_1,veiculo_2,veiculo_3,veiculo_4,veiculo_5',
        ]);
        $image->update(['type' => $request->type]);
        return back()->with('success', 'Tipo da imagem atualizado!');
    }

    public function toggle(Image $image)
    {
        $this->authorizeImage($image);
        $image->update(['is_active' => ! $image->is_active]);
        return back()->with('success', 'Status da imagem alterado!');
    }

    public function destroy(Image $image)
    {
        $this->authorizeImage($image);
        Storage::disk('public')->delete($image->path);
        $image->delete();
        return back()->with('success', 'Imagem removida.');
    }

    private function authorizeImage(Image $image): void
    {
        $user = auth()->user();
        if (! $user->isAdmin() && $image->user_id !== $user->id) {
            abort(403);
        }
    }
}
