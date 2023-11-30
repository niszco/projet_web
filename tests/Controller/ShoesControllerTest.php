<?php

namespace App\Test\Controller;

use App\Entity\Shoes;
use App\Repository\ShoesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShoesControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ShoesRepository $repository;
    private string $path = '/shoes/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Shoes::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Shoe index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'shoe[name]' => 'Testing',
            'shoe[price]' => 'Testing',
            'shoe[description]' => 'Testing',
            'shoe[color]' => 'Testing',
            'shoe[image]' => 'Testing',
            'shoe[size]' => 'Testing',
            'shoe[brands]' => 'Testing',
        ]);

        self::assertResponseRedirects('/shoes/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Shoes();
        $fixture->setName('My Title');
        $fixture->setPrice('My Title');
        $fixture->setDescription('My Title');
        $fixture->setColor('My Title');
        $fixture->setImage('My Title');
        $fixture->setSize('My Title');
        $fixture->setBrands('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Shoe');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Shoes();
        $fixture->setName('My Title');
        $fixture->setPrice('My Title');
        $fixture->setDescription('My Title');
        $fixture->setColor('My Title');
        $fixture->setImage('My Title');
        $fixture->setSize('My Title');
        $fixture->setBrands('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'shoe[name]' => 'Something New',
            'shoe[price]' => 'Something New',
            'shoe[description]' => 'Something New',
            'shoe[color]' => 'Something New',
            'shoe[image]' => 'Something New',
            'shoe[size]' => 'Something New',
            'shoe[brands]' => 'Something New',
        ]);

        self::assertResponseRedirects('/shoes/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getPrice());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getColor());
        self::assertSame('Something New', $fixture[0]->getImage());
        self::assertSame('Something New', $fixture[0]->getSize());
        self::assertSame('Something New', $fixture[0]->getBrands());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Shoes();
        $fixture->setName('My Title');
        $fixture->setPrice('My Title');
        $fixture->setDescription('My Title');
        $fixture->setColor('My Title');
        $fixture->setImage('My Title');
        $fixture->setSize('My Title');
        $fixture->setBrands('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/shoes/');
    }
}
