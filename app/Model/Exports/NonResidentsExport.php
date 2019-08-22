<?php

namespace App\Model\Exports;

use App\Model\NonResidents;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NonResidentsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;
    public $lang;
    public function __construct($lang)
    {
        $this->lang = $lang;
    }

    public function headings(): array{
        $columns = [
            'en' => [
                'Name', 'Surname',
                'Direction', 'Date of Birth', 'Citizenship',
                'Passport number', 'Residential address',
                'Language of instruction','Phone number', 'Date of creation'
            ],
            'ru' => [
                'Имя', 'Фамилия',
                'Направление', 'Дата рождения', 'Гражданство',
                'Серия и номер паспорта', 'Адрес проживания',
                'Язык обучения', 'Номер телефона', 'Дата создания'
            ],
            'uz' => [
                'Ism', 'Familiya',
                'Yo\'nalish', 'Tug\'ilgan kun', 'Fuqarolik',
                'Pasport raqami', 'Turar joy manzili',
                'Ta\'lim tili', 'Telefon raqami', 'Yaratilgan kun'
            ]
        ];

        return $columns[$this->lang];
    }

    public function collection()
    {
        $non_residents = NonResidents::all();
        $exelColums = [];
        $text_direction = [
            [
                'en' => 'Exact sciences',
                'ru' => 'Точные науки',
                'uz' => 'Aniq fanlar'
            ],
            [
                'en' => 'Foreign philology',
                'ru' => 'Зарубежная филология',
                'uz' => 'Xorijiy filologiya'
            ]
        ];
        foreach ($non_residents as $item) {
            $exelColums[] = [
                [
                    $item['name'],
                    $item['surname'],
                    $item['direction_code'] == 3910001 ? $text_direction[0][$this->lang] : $text_direction[1][$this->lang],
                    $item['date_of_birth'],
                    $item['citizenship'],
                    $item['client_requisite'],
                    $item['residential_address'],
                    $item['education_language'],
                    $item['phone'],
                    $item['created_at'],
                ]
            ];
        }

        return new Collection($exelColums);
    }
}
