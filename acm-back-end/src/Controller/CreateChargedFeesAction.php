<?php

namespace App\Controller;

use App\Entity\ChargedFees;
use App\Entity\Enum\ChargedFeesState;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class CreateChargedFeesAction
{
    public function __invoke(Request $request): ChargedFees
    {
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required'.$request);
        }

        $chargedFees = new ChargedFees();
        $chargedFees->file = $uploadedFile;
        $chargedFees->state = ChargedFeesState::LOADED;

        return $chargedFees;
    }
}