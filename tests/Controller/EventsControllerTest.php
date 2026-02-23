<?php

namespace App\Test\Controller;

use App\Entity\Events;
use App\Entity\EventsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EventsRepository $repository;
    private string $path = '/event/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Events::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Event index');

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
            'event[titreevent]' => 'Testing',
            'event[nomcoach]' => 'Testing',
            'event[typeevent]' => 'Testing',
            'event[adresseevent]' => 'Testing',
            'event[prixevent]' => 'Testing',
            'event[dateevent]' => 'Testing',
            'event[imgevent]' => 'Testing',
            'event[nombreplacesreservees]' => 'Testing',
            'event[nombreplacestotal]' => 'Testing',
            'event[idUser]' => 'Testing',
            'event[idtype]' => 'Testing',
        ]);

        self::assertResponseRedirects('/event/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Events();
        $fixture->setTitreevent('My Title');
        $fixture->setNomcoach('My Title');
        $fixture->setTypeevent('My Title');
        $fixture->setAdresseevent('My Title');
        $fixture->setPrixevent('My Title');
        $fixture->setDateevent('My Title');
        $fixture->setImgevent('My Title');
        $fixture->setNombreplacesreservees('My Title');
        $fixture->setNombreplacestotal('My Title');
        $fixture->setIdUser('My Title');
        $fixture->setIdtype('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Event');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Events();
        $fixture->setTitreevent('My Title');
        $fixture->setNomcoach('My Title');
        $fixture->setTypeevent('My Title');
        $fixture->setAdresseevent('My Title');
        $fixture->setPrixevent('My Title');
        $fixture->setDateevent('My Title');
        $fixture->setImgevent('My Title');
        $fixture->setNombreplacesreservees('My Title');
        $fixture->setNombreplacestotal('My Title');
        $fixture->setIdUser('My Title');
        $fixture->setIdtype('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'event[titreevent]' => 'Something New',
            'event[nomcoach]' => 'Something New',
            'event[typeevent]' => 'Something New',
            'event[adresseevent]' => 'Something New',
            'event[prixevent]' => 'Something New',
            'event[dateevent]' => 'Something New',
            'event[imgevent]' => 'Something New',
            'event[nombreplacesreservees]' => 'Something New',
            'event[nombreplacestotal]' => 'Something New',
            'event[idUser]' => 'Something New',
            'event[idtype]' => 'Something New',
        ]);

        self::assertResponseRedirects('/event/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitreevent());
        self::assertSame('Something New', $fixture[0]->getNomcoach());
        self::assertSame('Something New', $fixture[0]->getTypeevent());
        self::assertSame('Something New', $fixture[0]->getAdresseevent());
        self::assertSame('Something New', $fixture[0]->getPrixevent());
        self::assertSame('Something New', $fixture[0]->getDateevent());
        self::assertSame('Something New', $fixture[0]->getImgevent());
        self::assertSame('Something New', $fixture[0]->getNombreplacesreservees());
        self::assertSame('Something New', $fixture[0]->getNombreplacestotal());
        self::assertSame('Something New', $fixture[0]->getIdUser());
        self::assertSame('Something New', $fixture[0]->getIdtype());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Events();
        $fixture->setTitreevent('My Title');
        $fixture->setNomcoach('My Title');
        $fixture->setTypeevent('My Title');
        $fixture->setAdresseevent('My Title');
        $fixture->setPrixevent('My Title');
        $fixture->setDateevent('My Title');
        $fixture->setImgevent('My Title');
        $fixture->setNombreplacesreservees('My Title');
        $fixture->setNombreplacestotal('My Title');
        $fixture->setIdUser('My Title');
        $fixture->setIdtype('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/event/');
    }
}
