<?php

namespace App\Filament\Resources\ServerResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Crypt;
use App\Filament\Resources\ServerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateServer extends CreateRecord
{
  protected static string $resource = ServerResource::class;

  protected function mutateFormDataBeforeCreate(array $data): array
  {
    $data['secret'] = Crypt::encryptString($data['secret']);

    return $data;
  }
}
