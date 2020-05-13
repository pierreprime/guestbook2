<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConferenceController extends AbstractController
{
    /**
     * @Route("/hello/{name}", name="conference")
     */
    public function index(string $name = '')
    {
        $greet = '';

        if($name){
            $greet = sprintf('<h1>Hello %s!</h1>', htmlspecialchars($name));
        }

        return new Response(<<<EOF
<html>
<body>
$greet
<img src="/images/wip.gif" />
</body>
</html>
EOF
);

//        return $this->render('conference/index.html.twig', [
//            'controller_name' => 'ConferenceController',
//        ]);
    }
}
