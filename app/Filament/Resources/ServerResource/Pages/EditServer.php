<?php

namespace App\Filament\Resources\ServerResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Crypt;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ServerResource;

class EditServer extends EditRecord
{
  protected static string $resource = ServerResource::class;

  protected function getHeaderActions(): array
  {
    return [
      Actions\DeleteAction::make(),
    ];
  }

  protected function mutateFormDataBeforeFill(array $data): array
  {

    $secret = Crypt::decryptString($data['secret']);

    $length = strlen($secret);
    $revealLength = 3;

    $obfuscatedPart = str_repeat('*', $length - $revealLength);
    $visiblePart = substr($secret, -$revealLength);

    $data['secret'] = $obfuscatedPart . $visiblePart;

    return $data;
  }

  protected function mutateFormDataBeforeSave(array $data): array
  {
    $data['secret'] = Crypt::encryptString($data['secret']);

    return $data;
  }

  protected function afterSave(): void
  {
    $this->js('window.location.reload()');
  }
}
