<?php

namespace App\Model\Exports;

use App\Model\Residents;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResidentsExport implements FromCollection, WithHeadings, ShouldAutoSize
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
                'Name', 'Surname', 'Name of the educational institution',
                'Direction', 'Date of Birth', 'Citizenship',
                'Passport number', 'Residential address', 'School Region (City / Province)',
                'School (District / City)', 'School number or name', 'Year of graduation',
                'Language of instruction', 'Certificate number', 'Act number',
                'Phone number', 'Date of creation'
            ],
            'ru' => [
                'Имя', 'Фамилия', 'Наименование Учебного заведения',
                'Направление', 'Дата рождения', 'Гражданство',
                'Серия и номер паспорта', 'Адрес проживания', 'Школа Регион (Город / Область)',
                'Школа (Район / Город)', 'Номер или название школы', 'Год окончания школы',
                'Язык обучения', 'Номер аттестата', 'Номер акта',
                'Номер телефона', 'Дата создания'
            ],
            'uz' => [
                'Ism', 'Familiya', 'Ta\'lim muassasasining nomi',
                'Yo\'nalish', 'Tug\'ilgan kun', 'Fuqarolik',
                'Pasport raqami', 'Turar joy manzili', 'Maktab hududi (Shahar / Viloyat)',
                'Maktab (Tuman / Shahar)', 'Maktabning raqami yoki nomi', 'Bitirgan yili',
                'Ta\'lim tili', 'Attestat raqami', 'Act raqami',
                'Telefon raqami', 'Yaratilgan kun'
            ]
        ];

        return $columns[$this->lang];
    }

    public function collection()
    {
        $residents = Residents::all();
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
        foreach ($residents as $item) {
            $exelColums[] = [
                [
                    $item['name'],
                    $item['surname'],
                    $item['place_of_education'],
                    $item['direction_code'] == 3910001 ? $text_direction[0][$this->lang] : $text_direction[1][$this->lang],
                    $item['date_of_birth'],
                    $item['citizenship'],
                    $item['client_requisite'],
                    $item['residential_address'],
                    $item['school_region'],
                    $item['school_district'],
                    $item['school_number_or_name'],
                    $item['graduation_year'],
                    $item['education_language'],
                    $item['certificate_number'],
                    $item['act_number'],
                    $item['phone'],
                    $item['created_at'],
                ]
            ];
        }

        return new Collection($exelColums);
    }
}
