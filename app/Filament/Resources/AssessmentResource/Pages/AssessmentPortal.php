<?php

namespace App\Filament\Resources\AssessmentResource\Pages;

use App\Filament\Resources\AssessmentResource;
use Filament\Resources\Pages\Page;

class AssessmentPortal extends Page
{
    protected static string $resource = AssessmentResource::class;

    protected static string $view = 'filament.resources.assessment-resource.pages.assessment-portal';
}
