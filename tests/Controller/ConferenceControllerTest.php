<?php


namespace App\Tests\Controller;

use Symfony\Component\Panther\PantherTestCase;

class ConferenceControllerTest extends PantherTestCase
{
    public function testIndex()
    {
        $client = static::createPantherClient(['external_base_uri' => $_SERVER['SYMFONY_DEFAULT_ROUTE_URL']]);
        $client->request('GET', '/conferences');

//        echo $client->getResponse();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Give your feedback');
    }

    public function testCommentSubmission()
    {
        $client = static::createClient();
        $client->request('GET', 'conference/athens-2004');
        $client->submitForm('Submit', [
            'comment_form[author]' => 'Myself',
            'comment_form[text]' => 'This conference was antique',
            'comment_form[email]' => 'me@automat.me',
            'comment_form[photo]' => dirname(__DIR__, 2).'/public/images/wip.gif',
        ]);
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertSelectorExists('div:contains("There are 1 comments")');
    }

    public function testConferencePage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/conferences');

        $this->assertCount(2, $crawler->filter('h4'));
        $client->clickLink('View');

        $this->assertPageTitleContains('Sydney');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Sydney 2000');
        $this->assertSelectorExists('div:contains("There are 1 comments")');
    }
}