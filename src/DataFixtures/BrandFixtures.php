<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public const BRAND = "Brand :";

    public function load(ObjectManager $manager): void
    {   
        $brands = ["Addidas", "Reebook", "Salomon", "New Balance", "Nike", "Timberland", "Volcom", "Hoka", "Asics", "Vans", "Carhartt"];
        
        foreach ($brands as $brandName) {
            $brand = new Brand();
            $brand->setName($brandName);

            $manager->persist($brand);

            $this->addReference(self::BRAND . $brandName, $brand);
        }
        $manager->flush();
    }
}

