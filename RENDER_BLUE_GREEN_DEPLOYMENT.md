# Blue-green deployment on Render

Render web services do not provide an atomic blue-green switch in `render.yaml`. Use two services backed by the same PostgreSQL database:

1. Keep `nere-mining-blue` on `production-stable` and deploy the candidate image.
2. Run migrations using backward-compatible expand/contract migrations only.
3. Verify `/up`, the public homepage, `/sitemap.xml`, the admin login, and a representative form on the blue service URL.
4. Point the custom domain at the verified service in Render, or promote the service through the Render dashboard/API.
5. Keep the previous green service running until smoke tests pass, then scale it down.
6. Roll back by moving the custom domain back to green. Never roll back a database migration that has already removed columns; use a forward fix.

Required operational settings:

- `APP_DEBUG=false`
- `LOG_CHANNEL=stderr`
- `SESSION_DRIVER=database`
- `FORCE_HTTPS=true`
- health check: `/up`

The application must not run destructive seeders during a blue-green deploy. Editorial imports must be idempotent and migrations must be backward compatible.