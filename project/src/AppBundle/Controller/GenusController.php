<?php
/**
 * Created by Dmytro Gorpynenko.
 * User: dgo@ciklum.com
 * Date: 14.11.16
 * Time: 00:26
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class GenusController extends Controller
{
    /**
     * @Route ("/genus/{name}")
     */
    public function showAction($name)
    {
        $funFact = 'Octopuses can change the color of their body in just *three-tenths* of a second!';
        // $cache = $this->get('doctrine_cache.providers.my_markdown_cache');
        // $key = md5($funFact);
        // if ($cache->contains($key)) {
        //     $funFact = $cache->fetch($key);
        // } else {
        //     // sleep(1); // fake how slow this could be
        //     $funFact = $this->get('markdown.parser')
        //         ->transform($funFact);
        //     $cache->save($key, $funFact);
        // }

        $notes = [
            'Octopus asked me a riddle, outsmarted me',
            'I counted 8 legs... as they wrapped around me',
            'Inked!'
        ];
        return $this->render('genus/show.html.twig', array(
            'name' => $name,
            'notes' => $notes,
            'funFact' => $funFact
        ));
    }
}