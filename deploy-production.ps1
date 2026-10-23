param(
    [string] $ProjectPath = $PSScriptRoot,

    [string] $AppPoolName = 'NereMining'
)

$ErrorActionPreference = 'Stop'

if (-not (Test-Path -LiteralPath $ProjectPath -PathType Container)) {
    throw "Le dossier du site IIS n'existe pas : $ProjectPath"
}

$trackedChanges = @()
$trackedChanges += git -C $ProjectPath diff --name-only
if ($LASTEXITCODE -ne 0) {
    throw 'Impossible de vérifier les modifications non indexées du dépôt IIS.'
}

$trackedChanges += git -C $ProjectPath diff --cached --name-only
if ($LASTEXITCODE -ne 0) {
    throw 'Impossible de vérifier les modifications indexées du dépôt IIS.'
}

if ($trackedChanges) {
    Write-Host 'Fichiers suivis modifiés :'
    $trackedChanges | Sort-Object -Unique | ForEach-Object { Write-Host "  $_" }
    throw 'Le déploiement est arrêté pour protéger les modifications locales suivies.'
}

$untrackedFiles = @(git -C $ProjectPath ls-files --others --exclude-standard)
if ($LASTEXITCODE -ne 0) {
    throw 'Impossible de vérifier les fichiers non suivis du dépôt IIS.'
}

if ($untrackedFiles) {
    Write-Warning 'Fichiers non suivis présents. Ils ne seront pas supprimés par le script :'
    $untrackedFiles | ForEach-Object { Write-Warning "  $_" }
}

Write-Host 'Récupération de la version production-stable...'
git -C $ProjectPath fetch origin production-stable
if ($LASTEXITCODE -ne 0) {
    throw 'Échec de git fetch. Vérifiez la connexion Git du compte du runner.'
}

git -C $ProjectPath checkout --detach refs/remotes/origin/production-stable
if ($LASTEXITCODE -ne 0) {
    throw "Impossible de passer sur production-stable. Si Git signale un conflit avec un fichier non suivi, sauvegardez ou déplacez uniquement le fichier indiqué puis relancez. Vérifiez avec : git -C `"$ProjectPath`" status --short --untracked-files=all"
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
