<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Record;

use MoonShine\Fields\Number;
use MoonShine\Fields\Phone;
use MoonShine\Fields\Text;
use MoonShine\Handlers\ExportHandler;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class RecordResource extends ModelResource
{
    protected string $model = Record::class;

    protected string $title = 'Руйхати предзапись';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('ФИО', 'fio')->showOnExport()->readonly(),
                Phone::make('Номер Телефона', 'phone')->showOnExport()->readonly(),
                Number::make('Доход', 'maosh')->showOnExport()->readonly(),
                Text::make('Работает в', 'working_in')->showOnExport()->readonly(),
                Text::make('Телеграм ИД', 'telegram_id')->showOnExport()->readonly()
            ]),
        ];
    }
    public function export(): ?ExportHandler
    {
        return ExportHandler::make('Export')
            // Выбор диска
            ->disk('public')
            // Выбор директории сохранения файла экспорта
            ->dir('/exports');
   }
    public function rules(Model $item): array
    {
        return [];
    }
}
