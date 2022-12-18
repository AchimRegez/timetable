<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        $stationRigiblick = file_get_contents('http://transport.opendata.ch/v1/stationboard?station=Steinhausen,Rigiblick&limit=5');
        // dump(json_decode($stationRigiblick));

        $stationRiedstrasse = file_get_contents('http://transport.opendata.ch/v1/stationboard?station=Cham,Riedstrasse&limit=5');
        // dump(json_decode($stationRiedstrasse));
        
        $stationRigiblick=json_decode($stationRigiblick);        
        $stationRiedstrasse=json_decode($stationRiedstrasse);

        $stationRigiblick = $this->calcDeparture($stationRigiblick);
        $stationRiedstrasse = $this->calcDeparture($stationRiedstrasse);

        $data['stationRiedstrasse']=$stationRiedstrasse;
        $data['stationRigiblick']=$stationRigiblick;
        return $this->render('home/index.html.twig', [
            'data' => $data,
        ]);
    }  



    public function calcDeparture($stationData)
    {
        foreach($stationData->stationboard as $boardEntry)
        {
            //getDate
            $departureTime = $boardEntry->stop->departure;            
            $totalDelay = $boardEntry->stop->delay + 6;
            //calculate depature in minutes
            $date = new DateTime($departureTime);
            $date->add(new \DateInterval("PT{$totalDelay}M"));
            $depatureInMinutesHours = $date->diff(new DateTime())->format("%h Stunden %i Minuten");
            $boardEntry->calculatedDeparture = $depatureInMinutesHours;             
        }        
        return $stationData;
    }

    
}
