<?php

class QuestionsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('questions')->delete();
        $questions = [
            'Go out with the boys?',
            'Go out with the girls?',
            'Hit up the joint account to buy something for myself?',
            'Plan a holiday?',
            'Wear "her" clothes?',
            'Wear "his" clothes?',
            'Invite company to the house?',
            'Pull the goalie?',
            'Throw a playdate?',
            'Eat the leftovers?',
            'Start an extreme diet?',
            'Ask for a sexual favour?',
            'Paint the walls?',
            'Hang out with an ex?',
            'Do an outdoor activity?',
            'Go to the strip club?',
            'Go dancing?',
            'Go shopping?',
            'Buy jewelry?',
            'Eat dinner out'
        ];
        foreach ($questions as $question) {
            Question::create([
                'question' => $question,
                'user_id'  => null
            ]);
        }

    }

}
