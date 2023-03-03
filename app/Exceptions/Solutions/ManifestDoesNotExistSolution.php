<?php

namespace Pterodactyl\Exceptions\Solutions;

use Spatie\Ignition\Contracts\Solution;

class ManifestDoesNotExistSolution implements Solution
{
    public function getSolutionTitle(): string
    {
        return 'O arquivo manifest.json ainda não foi gerado';
    }

    public function getSolutionDescription(): string
    {
        return 'Execute yarn run build:production para construir o frontend primeiro.';
    }

    public function getDocumentationLinks(): array
    {
        return [
            'Docs' => 'https://github.com/pterodactyl/panel/blob/develop/package.json',
        ];
    }
}
