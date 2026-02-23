<?php

namespace App\Test\Controller;

use App\Entity\produit;
use App\Repository\produitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class produitControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private produitRepository $repository;
    private string $path = '/produit/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(produit::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('produit index');

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
            'produit[idadmin]' => 'Testing',
            'produit[titre]' => 'Testing',
            'produit[image]' => 'Testing',
            'produit[date]' => 'Testing',
            'produit[description]' => 'Testing',
            'produit[categorie]' => 'Testing',
            'produit[idcategorie]' => 'Testing',
        ]);

        self::assertResponseRedirects('/produit/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new produit();
        $fixture->setIdadmin('My Title');
        $fixture->setTitre('My Title');
        $fixture->setImage('My Title');
        $fixture->setDate('My Title');
        $fixture->setDescription('My Title');
        $fixture->setCategorie('My Title');
        $fixture->setIdcategorie('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('produit');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new produit();
        $fixture->setIdadmin('My Title');
        $fixture->setTitre('My Title');
        $fixture->setImage('My Title');
        $fixture->setDate('My Title');
        $fixture->setDescription('My Title');
        $fixture->setCategorie('My Title');
        $fixture->setIdcategorie('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'produit[idadmin]' => 'Something New',
            'produit[titre]' => 'Something New',
            'produit[image]' => 'Something New',
            'produit[date]' => 'Something New',
            'produit[description]' => 'Something New',
            'produit[categorie]' => 'Something New',
            'produit[idcategorie]' => 'Something New',
        ]);

        self::assertResponseRedirects('/produit/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getIdadmin());
        self::assertSame('Something New', $fixture[0]->getTitre());
        self::assertSame('Something New', $fixture[0]->getImage());
        self::assertSame('Something New', $fixture[0]->getDate());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getCategorie());
        self::assertSame('Something New', $fixture[0]->getIdcategorie());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new produit();
        $fixture->setIdadmin('My Title');
        $fixture->setTitre('My Title');
        $fixture->setImage('My Title');
        $fixture->setDate('My Title');
        $fixture->setDescription('My Title');
        $fixture->setCategorie('My Title');
        $fixture->setIdcategorie('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/produit/');
    }
}
