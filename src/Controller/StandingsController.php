<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Countries Controller
 *
 * @property \App\Model\Table\CountriesTable $Countries
 */
class StandingsController extends AppController
{
    /**
     * @inheritDoc
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Countries');
    }

    /**
     *
     */
    public function index()
    {
        $countries = $this->Countries->find()
            ->orderDesc('gold_medal_count')
            ->orderDesc('silver_medal_count')
            ->orderDesc('bronze_medal_count')
            ->toArray();

        $this->set(compact('countries'));
    }

}
