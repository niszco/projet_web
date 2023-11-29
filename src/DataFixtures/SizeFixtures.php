<?php

namespace App\DataFixtures;

use App\Entity\Size;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SizeFixtures extends Fixture
{

    public const SIZE = "Size :";

    public function load(ObjectManager $manager): void
    {
        $sizeShoesData = [
            '35',
            '36',
            '37',
            '38',
            '39',
            '40',
            '41',
            '42',
            '43',
            '44',
            '45',
            '46',
            '47',
            '48',
            '49',
            '50',
            '51'
        ];

        $sizeClothesData = [
            'XS',
            'S',
            'M',
            'L',
            'XL',
            'XXL',
            '3XL'
        ];

        foreach ($sizeShoesData as $sizes) {
            $size = new Size();
            $size
                ->setName($sizes);

            $manager->persist($size);

            $this->addReference(self::SIZE . $sizes, $size);
        }
            foreach ($sizeClothesData as $sizes) {
                $size = new Size();
                $size
                    ->setName($sizes);

                $manager->persist($size);

                $this->addReference(self::SIZE . $sizes, $size);
        }
        $manager->flush();
    }
}
