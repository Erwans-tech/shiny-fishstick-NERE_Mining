param(
    [Parameter(Mandatory = $true)]
    [string] $ProjectPath,

    [string] $AppPoolName = 'NereMining'
)

$ErrorActionPreference = 'Stop'

if (-not (Test-Path -LiteralPath $ProjectPath -PathType Container)) {
    throw "Le dossier du site IIS n'existe pas : $ProjectPath"
}

$branch = git -C $ProjectPath rev-parse --abbrev-ref HEAD
if ($LASTEXITCODE -ne 0) {
    throw 'Impossible de déterminer la branche Git du site IIS.'
}

if ($branch -ne 'production-stable') {
    throw "Le site IIS doit être sur production-stable. Branche actuelle : $branch"
}

$changes = git -C $ProjectPath status --porcelain
if ($LASTEXITCODE -ne 0) {
    throw 'Impossible de vérifier l’état du dépôt sur le serveur IIS.'
}

if ($changes) {
    throw 'Le dépôt du site contient des changements locaux. Aucun fichier ne sera écrasé.'
}

Write-Host 'Récupération de la version production-stable...'
git -C $ProjectPath fetch origin production-stable
if ($LASTEXITCODE -ne 0) {
    throw 'Échec de git fetch. Vérifiez la connexion Git du compte du runner.'
}

git -C $ProjectPath pull --ff-only origin production-stable
if ($LASTEXITCODE -ne 0) {
    throw 'Échec du pull fast-forward. Le site IIS n’a pas été mis à jour.'
}

Push-Location $ProjectPath
try {
    Write-Host 'Installation des dépendances PHP...'
    composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader
    if ($LASTEXITCODE -ne 0) {
        throw 'Échec de composer install.'
    }

    Write-Host 'Nettoyage de la configuration Laravel...'
    php artisan config:clear
    if ($LASTEXITCODE -ne 0) {
        throw 'Échec du nettoyage de la configuration Laravel.'
    }

    Write-Host 'Exécution des migrations...'
    php artisan migrate --force --no-interaction
    if ($LASTEXITCODE -ne 0) {
        throw 'Échec des migrations Laravel.'
    }

    php artisan config:cache
    if ($LASTEXITCODE -ne 0) {
        throw 'Échec de la mise en cache de la configuration Laravel.'
    }

}
finally {
    Pop-Location
}

if ([string]::IsNullOrWhiteSpace($AppPoolName)) {
    $AppPoolName = 'NereMining'
}

Import-Module WebAdministration -ErrorAction Stop
if (-not (Test-Path "IIS:\AppPools\$AppPoolName")) {
    throw "Le pool IIS '$AppPoolName' n'existe pas. Définissez IIS_APP_POOL_NAME dans les variables GitHub."
}

Restart-WebAppPool -Name $AppPoolName
Write-Host "Déploiement terminé. Le pool IIS '$AppPoolName' a été recyclé."
