<?php

/**
 * Google Analytics 4
 *
 * L'ID de mesure est une valeur publique (il apparait deja dans le HTML
 * envoye au navigateur) : il n'a pas vocation a etre un secret. Il est
 * configurable par environnement pour ne pas avoir a redployer le site
 * lorsqu'on cree une nouvelle propriete, et pour ne pas melanger les
 * donnees d'un environnement de recette avec celles de la production.
 */
return [

    /**
     * ID de mesure GA4, au format G-XXXXXXXXXX.
     * Laisser vide pour desactiver completement le tag.
     */
    'measurement_id' => env('GA_MEASUREMENT_ID', 'G-K1QQ6E195H'),

    /**
     * Tracking des pages vues.
     *
     * Passe a false pour desactiver le tag sans toucher a l'ID : utile pour
     * une maintenance, ou pour un environnement ou l'on ne veut aucune donnee.
     */
    'enabled' => env('GA_ENABLED', true),

];
