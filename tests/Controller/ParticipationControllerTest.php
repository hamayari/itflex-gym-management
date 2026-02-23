<?php

namespace App\Test\Controller;

use App\Entity\Participation;
use App\Entity\ParticipationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ParticipationControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ParticipationRepository $repository;
    private string $path = '/participation/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Participation::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Participation index');

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
            'participation[nom]' => 'Testing',
            'participation[prenom]' => 'Testing',
            'participation[ntel]' => 'Testing',
            'participation[datepart]' => 'Testing',
            'participation[idUser]' => 'Testing',
        ]);

        self::assertResponseRedirects('/participation/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Participation();
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setNtel('My Title');
        $fixture->setDatepart('My Title');
        $fixture->setIdUser('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Participation');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Participation();
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setNtel('My Title');
        $fixture->setDatepart('My Title');
        $fixture->setIdUser('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'participation[nom]' => 'Something New',
            'participation[prenom]' => 'Something New',
            'participation[ntel]' => 'Something New',
            'participation[datepart]' => 'Something New',
            'participation[idUser]' => 'Something New',
        ]);

        self::assertResponseRedirects('/participation/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getPrenom());
        self::assertSame('Something New', $fixture[0]->getNtel());
        self::assertSame('Something New', $fixture[0]->getDatepart());
        self::assertSame('Something New', $fixture[0]->getIdUser());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Participation();
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setNtel('My Title');
        $fixture->setDatepart('My Title');
        $fixture->setIdUser('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/participation/');
    }
}
