<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbackTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('feedback')->insert([
            [
                'id_profile' => 1,
                'comment' => 'Quando entrei para a faculdade, não tinha certeza de qual caminho seguir. Mas as aulas me abriram os olhos para um mundo de possibilidades. A paixão pela ... surgiu de forma inesperada e me motivou a buscar cada vez mais conhecimento. Hoje, trabalho como ... em uma empresa que admiro e posso afirmar que a minha formação foi fundamental para alcançar esse sucesso.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_profile' => 2,
                'comment' => 'A faculdade me proporcionou um ambiente de aprendizado único, com professores altamente qualificados e dispostos a compartilhar seus conhecimentos. As atividades práticas, os projetos em grupo e as visitas técnicas foram cruciais para a minha formação. Graças a essa experiência, consegui desenvolver habilidades que são essenciais para o meu trabalho atual.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,
            [
                'id_profile' => 3,
                'comment' => 'Além do conhecimento técnico, a faculdade me proporcionou a oportunidade de construir relacionamentos duradouros com colegas e professores. Essas relações foram fundamentais para o meu crescimento profissional. Hoje, muitos dos meus amigos de faculdade são meus colegas de trabalho ou parceiros em projetos. A rede de contatos que construí na faculdade é um dos meus maiores patrimônios.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,
            [
                'id_profile' => 4,
                'comment' => 'A faculdade não foi fácil, mas os desafios que enfrentei me fizeram crescer como pessoa e profissional. Lembro-me de um desafio que parecia insuperável na época, mas com a ajuda dos meus professores e colegas, consegui superá-lo. Essa experiência me ensinou a ser mais resiliente e a acreditar sempre no meu potencial.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
