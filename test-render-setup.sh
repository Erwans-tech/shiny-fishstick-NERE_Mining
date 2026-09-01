#!/bin/bash

echo "🧪 Testing Render deployment setup locally..."

# Vérifier que les fichiers nécessaires existent
FILES=(
    "render.yaml"
    ".env.render"
    "composer.json"
    "artisan"
)

echo "📋 Checking required files..."
for file in "${FILES[@]}"; do
    if [[ -f "$file" ]]; then
        echo "✅ $file exists"
    else
        echo "❌ $file missing!"
        exit 1
    fi
done

# Vérifier les dépendances Composer
echo "📦 Checking Composer dependencies..."
if composer validate --no-check-publish; then
    echo "✅ composer.json is valid"
else
    echo "❌ composer.json has errors!"
    exit 1
fi

# Vérifier la syntaxe Laravel
echo "🔍 Checking Laravel configuration..."
if php artisan --version > /dev/null 2>&1; then
    echo "✅ Laravel artisan works"
else
    echo "❌ Laravel artisan has issues!"
    exit 1
fi

# Test de la configuration de base de données
echo "🗃️ Checking database configuration..."
if grep -q "DB_CONNECTION=pgsql" .env.render; then
    echo "✅ PostgreSQL configured in .env.render"
else
    echo "❌ PostgreSQL not configured!"
    exit 1
fi

# Vérifier que le driver PostgreSQL est disponible
echo "🐘 Checking PostgreSQL driver..."
if php -m | grep -q pdo_pgsql; then
    echo "✅ PDO PostgreSQL driver available"
else
    echo "⚠️  PDO PostgreSQL driver not available locally (normal, will be installed on Render)"
fi

echo ""
echo "🎯 Setup validation complete!"
echo ""
echo "📝 Next steps:"
echo "1. Create Supabase project and get connection details"
echo "2. Push code to GitHub/GitLab"
echo "3. Connect repository to Render"
echo "4. Set environment variables in Render dashboard"
echo "5. Deploy!"
echo ""
echo "🔗 Useful links:"
echo "- Supabase: https://supabase.com"
echo "- Render: https://render.com"
echo "- Migration guide: MIGRATION_RENDER_SUPABASE.md"