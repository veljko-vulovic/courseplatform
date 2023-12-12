<?php

namespace App\Filament\Resources\VideoResource\Pages;

use App\Filament\Resources\VideoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;

class CreateVideo extends CreateRecord
{
    protected static string $resource = VideoResource::class;
   
    protected function mutateFormDataBeforeCreate(array $data): array 
    {
        $data['type'] = Storage::disk('public')->mimeType($data['url']);
        return $data;
    }
}
