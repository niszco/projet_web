<?php

namespace App\DataFixtures;

use App\Entity\Shoes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ShoesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $nikeBrand = $this->getReference(BrandFixtures::BRAND . "Nike");
        $vansBrand = $this->getReference(BrandFixtures::BRAND . "Vans");
        $size36 = $this->getReference(SizeFixtures::SIZE . "36");
        $size37 = $this->getReference(SizeFixtures::SIZE . "37");
        $size38 = $this->getReference(SizeFixtures::SIZE . "38");
        // TODO : Ajouter plus de Tailles et Marques !


        $shoesData = [

            ['Air Max', 120, 'Comfortable running shoes', 'Blue', 'nike-1.png', $nikeBrand, [$size36, $size37]],
            ['Ultrarange', 80, 'Classic casual shoes', 'White', 'vans-1.png', $vansBrand, [$size37, $size38]],
            // TODO : Ajouter plus de chaussures !
        ];

        foreach ($shoesData as [$name, $price, $description, $color, $image, $brand, $sizes]) {
            $shoe = new Shoes();
            $shoe
                ->setName($name)
                ->setPrice($price)
                ->setDescription($description)
                ->setColor($color)
                ->setImage($image)
                ->setBrands($brand);

            foreach ($sizes as $size) {
                $shoe->addSize($size);
            }

            $manager->persist($shoe);
        }

        $manager->flush();
    }

    // Ordre de chargements des Fixtures
    public function getDependencies(): array
    {
        return [
            BrandFixtures::class,
            SizeFixtures::class,
        ];
    }
}
