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
        $timberlandBrand = $this->getReference(BrandFixtures::BRAND . "Timberland");
        $adidasBrand = $this->getReference(BrandFixtures::BRAND . "Adidas");
        $reebokBrand = $this->getReference(BrandFixtures::BRAND . "Reebok");
        $hokaBrand = $this->getReference(BrandFixtures::BRAND . "Hoka");
        $newBalanceBrand = $this->getReference(BrandFixtures::BRAND . "New Balance");
        $size35 = $this->getReference(SizeFixtures::SIZE . "35");
        $size36 = $this->getReference(SizeFixtures::SIZE . "36");
        $size37 = $this->getReference(SizeFixtures::SIZE . "37");
        $size38 = $this->getReference(SizeFixtures::SIZE . "38");
        $size39 = $this->getReference(SizeFixtures::SIZE . "39");
        $size40 = $this->getReference(SizeFixtures::SIZE . "40");
        $size41 = $this->getReference(SizeFixtures::SIZE . "41");
        $size42 = $this->getReference(SizeFixtures::SIZE . "42");
        $size43 = $this->getReference(SizeFixtures::SIZE . "43");
        $size44 = $this->getReference(SizeFixtures::SIZE . "44");
        $size45 = $this->getReference(SizeFixtures::SIZE . "45");
        $size46 = $this->getReference(SizeFixtures::SIZE . "46");
        $size47 = $this->getReference(SizeFixtures::SIZE . "47");
        $size48 = $this->getReference(SizeFixtures::SIZE . "48");
        $size49 = $this->getReference(SizeFixtures::SIZE . "49");
        $size50 = $this->getReference(SizeFixtures::SIZE . "50");
        $size51 = $this->getReference(SizeFixtures::SIZE . "51");
        // TODO : Ajouter plus de Tailles et Marques !


        $shoesData = [

            ['Air Max', 120, 'Chaussure stylisé confortable', 'Orange / Beige / Jaune', 'nike-1.png', $nikeBrand, [$size36, $size37]],
            ['Ultrarange', 90, 'Chaussure de ville', 'Brun', 'vans-1.png', $vansBrand, [$size37, $size38]],
            ['9060', 130, 'Nouvelle collection', 'Noir / Gris', 'new-balance-1.png', $newBalanceBrand, [$size37, $size38, $size38, $size40, $size41, $size42]],
            ['Glide Ripple Clip', 90, 'Chaussure de ville', 'Blanc', 'reebok-1.png', $reebokBrand, [$size39, $size41, $size42, $size43, $size44, $size45]],
            ['Tecton X', 140, 'Chaussure de running', 'Orange Fluo', 'hoka-1.png', $hokaBrand, [$size37, $size38, $size39, $size41, $size42, $size46, $size48]],
            ['NY 90', 75, 'Chaussure de ville', 'Blanc', 'adidas-1.png', $adidasBrand, [$size40, $size41, $size42, $size43, $size44]],
            ['Air Max Bolt', 90, 'Chaussure de ville', 'Noir / Blanc', 'nike-2.png', $nikeBrand, [$size37, $size38, $size41, $size42]],
            ['Solar Wave', 110, 'Chaussure de ville', 'Kaki / Beige', 'timberland-1.png', $timberlandBrand, [$size39, $size40, $size41, $size43, $size44]],
            // TODO : Ajouter plus de Chaussures !
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
