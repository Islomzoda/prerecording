<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Record;

use MoonShine\Fields\Number;
use MoonShine\Fields\Phone;
use MoonShine\Fields\Text;
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
                Text::make('ФИО', 'fio')->readonly(),
                Phone::make('Номер Телефона', 'phone')->readonly(),
                Number::make('Доход', 'maosh')->readonly(),
                Text::make('Работает в', 'working_in')->readonly(),
                Text::make('Телеграм ИД', 'telegram_id')->readonly()
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
