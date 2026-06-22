<?php

namespace App\Services;

use Phpml\Clustering\KMeans;

class DesignacaoService
{
    public function designar($entregas, $motoboys): array
    {
        $k = min($motoboys->count(), $entregas->count());

        $samples = $entregas->map(fn($e) => [
            (int) str_replace('-', '', $e->cep),
        ])->toArray();

        $kmeans = new KMeans($k);
        $clusters = $kmeans->cluster($samples);

        $assignment = [];
        foreach ($clusters as $motoboyIdx => $cluster) {
            $motoboyDbId = $motoboys[$motoboyIdx]->id;
            foreach ($cluster as $sample) {
                $cepValue = $sample[0];
                foreach ($entregas as $entrega) {
                    $eCep = (int) str_replace('-', '', $entrega->cep);
                    if ($eCep === $cepValue && !isset($assignment[$entrega->id])) {
                        $assignment[$entrega->id] = $motoboyDbId;
                        break;
                    }
                }
            }
        }

        return $assignment;
    }
}
