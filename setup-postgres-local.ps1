# ============================================
# Script Setup PostgreSQL Local - Windows
# ============================================

Write-Host "🐘 Configuration PostgreSQL Local" -ForegroundColor Cyan
Write-Host "=================================" -ForegroundColor Cyan
Write-Host ""

# Variables
$pgPassword = "postgres"
$pgUser = "postgres"
$pgHost = "127.0.0.1"
$pgPort = 5432
$dbName = "nere_mining_dev"

# Étape 1: Vérifier PostgreSQL
Write-Host "1️⃣  Vérification de PostgreSQL..." -ForegroundColor Yellow
$env:PGPASSWORD = $pgPassword

try {
    $version = & psql -U $pgUser -h $pgHost -c "SELECT version();" 2>&1
    Write-Host "✓ PostgreSQL trouvé" -ForegroundColor Green
    Write-Host "  Version: $(($version | Select-String "PostgreSQL").ToString())" -ForegroundColor Gray
} catch {
    Write-Host "✗ PostgreSQL non trouvé ou pas lancé" -ForegroundColor Red
    Write-Host "  Veuillez installer PostgreSQL d'abord" -ForegroundColor Yellow
    Write-Host "  Téléchargez : https://www.postgresql.org/download/windows/" -ForegroundColor Yellow
    exit 1
}

Write-Host ""

# Étape 2: Créer la base de données
Write-Host "2️⃣  Création de la base de données..." -ForegroundColor Yellow

# Vérifier si la base existe
$dbExists = & psql -U $pgUser -h $pgHost -lqt 2>&1 | Select-String $dbName
if ($dbExists) {
    Write-Host "⚠️  La base '$dbName' existe déjà" -ForegroundColor Yellow
    $response = Read-Host "Voulez-vous la supprimer et la recréer ? (y/n)"
    if ($response -eq "y") {
        & psql -U $pgUser -h $pgHost -c "DROP DATABASE IF EXISTS $dbName;" 2>&1 | Out-Null
        Write-Host "✓ Base supprimée" -ForegroundColor Green
    } else {
        Write-Host "✓ Base existante conservée" -ForegroundColor Green
    }
}

# Créer la base
if (-not $dbExists -or $response -eq "y") {
    & psql -U $pgUser -h $pgHost -c "CREATE DATABASE $dbName ENCODING 'UTF8' LC_COLLATE 'C' LC_CTYPE 'C';" 2>&1 | Out-Null
    Write-Host "✓ Base de données '$dbName' créée" -ForegroundColor Green
}

Write-Host ""

# Étape 3: Vérifier la connexion Laravel
Write-Host "3️⃣  Vérification de la connexion Laravel..." -ForegroundColor Yellow

try {
    $tinkerOutput = php artisan tinker --execute "try { DB::connection()->getPdo(); echo '✓ Connecté'; } catch (Exception `$e) { echo '✗ Erreur: ' . `$e->getMessage(); }" 2>&1
    Write-Host "  $tinkerOutput" -ForegroundColor Green
} catch {
    Write-Host "⚠️  Tinker ne peut pas être testé" -ForegroundColor Yellow
}

Write-Host ""

# Étape 4: Résumé
Write-Host "✅ Configuration PostgreSQL Local" -ForegroundColor Green
Write-Host ""
Write-Host "Configuration .env :" -ForegroundColor Cyan
Write-Host "  DB_CONNECTION=pgsql" -ForegroundColor Gray
Write-Host "  DB_HOST=$pgHost" -ForegroundColor Gray
Write-Host "  DB_PORT=$pgPort" -ForegroundColor Gray
Write-Host "  DB_DATABASE=$dbName" -ForegroundColor Gray
Write-Host "  DB_USERNAME=$pgUser" -ForegroundColor Gray
Write-Host ""

# Étape 5: Prochaines étapes
Write-Host "📋 Prochaines étapes :" -ForegroundColor Yellow
Write-Host "  1. php artisan migrate" -ForegroundColor Gray
Write-Host "  2. php artisan serve" -ForegroundColor Gray
Write-Host "  3. Testez sur http://localhost:8000" -ForegroundColor Gray
Write-Host ""

Write-Host "💡 Pour plus d'infos : consultez POSTGRES_SETUP.md" -ForegroundColor Cyan
