<?php

namespace App\DataFixtures;

use App\Entity\Clothes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ClothesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $volcomBrand = $this->getReference(BrandFixtures::BRAND . "Volcom");
        $carharttBrand = $this->getReference(BrandFixtures::BRAND . "Carhartt");
        $reebokBrand = $this->getReference(BrandFixtures::BRAND . "Reebok");
        $filaBrand = $this->getReference(BrandFixtures::BRAND . "Fila");
        $newBalanceBrand = $this->getReference(BrandFixtures::BRAND . "New Balance");
        $sizeXS = $this->getReference(SizeFixtures::SIZE . "XS");
        $sizeS = $this->getReference(SizeFixtures::SIZE . "S");
        $sizeM = $this->getReference(SizeFixtures::SIZE . "M");
        $sizeL = $this->getReference(SizeFixtures::SIZE . "L");
        $sizeXL = $this->getReference(SizeFixtures::SIZE . "XL");
        // TODO : Ajouter plus de Tailles et Marques !


        $clothesData = [
            ['Polaire', 90, 'Polaire d\'hiver', 'Noir / Kaki', 'volcom-1.png', $volcomBrand, [$sizeXS, $sizeS, $sizeL]],
            ['Sweat à capuche', 120, 'Pullchaud et élégant', 'Ocre', 'carhartt-1.png', $carharttBrand, [$sizeS, $sizeM, $sizeL, $sizeXL]],
            ['Sweat Retro', 65, 'Pull retro oversize', 'Gris', 'reebok-2.png', $reebokBrand, [$sizeXS, $sizeM, $sizeL, $sizeXL]],
            ['Tee-Shirt Fila', 35, 'Tee-Shirt de sport', 'Bleu marine', 'fila-1.png', $filaBrand, [$sizeXS, $sizeS, $sizeM, $sizeL]],
            ['Tee-Shirt Oversize', 45, 'Tee-Shirt Casual', 'Vert', 'new-balance-2.png', $newBalanceBrand, [$sizeM, $sizeL]],
            // TODO : Ajouter plus de Vêtements !
        ];

        foreach ($clothesData as [$name, $price, $description, $color, $image, $brand, $sizes]) {
            $clothes = new Clothes();
            $clothes
                ->setName($name)
                ->setPrice($price)
                ->setDescription($description)
                ->setColor($color)
                ->setImage($image)
                ->setBrands($brand);

            foreach ($sizes as $size) {
                $clothes->addSize($size);
            }

            $manager->persist($clothes);
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
