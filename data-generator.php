<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/31/17
 * Time: 11:45 AM
 */
use CORE\App;
use CORE\Model;
use APP\Model\Offer;
use APP\Model\Professor;

/**
 * Simple data loader
 * @todo optimize.... (bulks insertions instead of singles)
 * @todo generate unique values... when added
 * @todo generate mandatory fields...
 *
 * @param App $app
 * @param array $data
 */
function generate(App $app, array $data)
{
    $db = &$app->rdbms;

    foreach ($data as $modelClass => $source) {
        $modelClass = 'APP\\Model\\' . $modelClass;

        for ($i = 0; $i < 50; $i++) {
            $values = array();

            foreach ($source as $column => $possibleValues) {
                $possibleValues = is_callable($possibleValues) ? $possibleValues($db) : $possibleValues;
                $values[$column] = $possibleValues[mt_rand(0, sizeof($possibleValues) - 1)] . ('name' == $column ? (' ' . $i) : '');
            }

//            var_dump($modelClass,$values);
            Model::create(new $modelClass($values), $db);
        }
    }
}

$db = &$app->rdbms;

$cache = array();

$getIds = function ($modelClass) use ($db, &$cache) {
    if (isset($cache[$modelClass])) {
        return $cache[$modelClass];
    }

    return $cache[$modelClass] = array_keys(Model::mapAsKeyToItem(Model::read(new $modelClass, $db)));
};

$offers = function () use ($getIds) {
    return $getIds(Offer::class);
};

$professors = function () use ($getIds) {
    return $getIds(Professor::class);
};

$data = array(
    'Offer' => array(
        'name' => array_map(function ($num) {
            return 'Course #' . $num;
        }, range(1, 15)),
        'price' => array_map(function ($num) {
            return $num + mt_rand(0, 100) / 100;
        }, range(50, 100)),
        /**
         * @todo use md5 hashes instead of raw names, do not store extensions(use single format - jpg for example)
         */
        'image' => array(
            '04.jpg',
            'cpe-sponrs.jpg',
            'free-training-course.jpg',
            '123123.png',
            'asd.png',
            'diploma-courses-250x250.jpg',
            'sddgdffg.jpg',
            '2342341.png',
            'docker_logo.png',
            'tlogo-1493706800.png',
            'CachedImage.png',
            'zxcqqw.jpg'
        ),
        'description' => array_map(function ($num) {
            $tmp = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum';
            $length = 30;
            $offset = mt_rand(0, strlen($tmp) - $length - 1);
            return substr($tmp, $offset, $length);
        }, range(1, 50))
    ),
    'Professor' => array(
        'name' => array(
            'George Washington',
            'Abraham Lincoln',
            'Mark Twain',
            'Henry Ford',
            'Humphrey Bogart',
            'Billie Holiday',
            'Elvis Presley',
            'Ernest Hemingway',
            'Marilyn Monroe',
            'John F Kennedy',
            'Bob Dylan',
            'Muhammad Ali',
            'Martin Luther King',
            'Neil Armstrong',
            'Jimi Hendrix'
        )
    ),
    'Offer\\Datetime' => array(
        'offer_id' => $offers,
        'datetime' => array(
            '2017-06-01 14:00:00',
            '2017-06-02 15:00:00',
            '2017-06-03 16:30:00',
            '2017-06-04 17:00:00',
            '2017-06-05 18:00:00',
            '2017-06-06 19:45:00',
            '2017-06-07 20:00:00',
            '2017-06-11 12:11:00',
            '2017-07-08 12:11:00',
            '2017-08-15 17:34:00',
            '2017-09-08 12:11:00',
            '2017-10-16 12:11:00',
        ),
        'duration' => range(60, 120)
    ),
    'Offer\\Professor' => array(
        'offer_id' => $offers,
        'professor_id' => $professors
    )
);

generate($app, $data);