# Commercial-Grade Project Audit (Laravel Luxury Salon App)

**Audit date:** 2026-03-28 (UTC)
**Audited branch:** `work`
**Scope reviewed:** all **tracked** repository files (`git ls-files` = 277 files), plus runtime/build artifacts present in working tree.

---

## 1) Executive Summary

This codebase is a promising functional prototype, but it is **not production-grade yet**. Critical gaps exist in:

- **Runtime integrity:** multiple routes map to missing views and at least one missing controller action.
- **Test reliability:** test suite currently allows server errors for some features (false green outcomes).
- **Security & repo hygiene:** `.env` is tracked with secrets; generated artifacts and cached framework files are tracked.
- **Consistency:** conflicting offer-expiry semantics across routes/controllers/tests.

**Current readiness:**
- **Prototype / staging:** workable with constraints.
- **Commercial production:** **not ready** without remediation.

---

## 2) Evidence-Based Findings (Critical / High / Medium)

## Critical

1. **Tracked runtime secret file (`.env`) with active `APP_KEY`**
   - `.env` is committed and contains a concrete `APP_KEY`.
   - Commercial environments must keep secrets out of VCS.

2. **Missing rendering surface for core routes**
   - Controllers return `services.index`, `products.index`, `offers.index`, `journal.index`, `bookings.index`, `bookings.show` views.
   - These blade templates are absent under `resources/views/`.
   - Result: runtime `500` errors on those routes.

3. **Broken route-controller contract**
   - `/bookings/create` route points to `BookingController@create`, but no `create()` method exists.
   - This is a hard runtime failure path.

4. **Repository polluted with generated artifacts**
   - Tracked: `storage/framework/views/*.php` (80 files), `bootstrap/cache/*.php`, `public/build/*`, `database/database.sqlite`.
   - This undermines deterministic deploys, causes merge churn, and risks environment coupling.

---

## High

1. **Test suite permits 500 responses as acceptable behavior**
   - Several feature tests explicitly accept HTTP 500, which masks actual regressions and prevents CI from being trustworthy.

2. **Offer validity logic is inconsistent by endpoint**
   - Home page uses `valid_until >= now()` while offers controller uses `valid_until > now()`.
   - Boundary behavior conflicts across endpoints and tests.

3. **Update validation reuses create rules with unique constraints**
   - `StoreOfferRequest` / `StoreJournalPostRequest` are reused for update actions.
   - Unique rules (`discount_code`, `slug`) can fail on no-op updates because the current record is not ignored.

4. **Public/Private behavior conflict in journal route intent**
   - Route comments label journal as public index route, but controller index authorizes admin only.
   - This is a product-definition conflict affecting UX and SEO crawlability.

5. **Potential race condition in booking overlap prevention**
   - Overlap check and booking creation are separate operations with no locking/transaction isolation for concurrent writes.
   - Under load, double-bookings can slip through.

---

## Medium

1. **Cache invalidation strategy is partial for bookings**
   - Cache purge only clears pages 1..10; users with >10 pages can see stale data.

2. **Missing hardening headers for commercial deployment**
   - Security middleware sets some useful headers but lacks CSP and HSTS policy management strategy.

3. **Weak infrastructure quality gates**
   - No CI config detected for lint/test/build enforcement.
   - Style gate currently fails (`pint --test`) across many first-party files.

4. **README not project-specific enough**
   - Still mostly Laravel boilerplate; does not document operational SLOs, security posture, data model contracts, backup/restore, or release policy.

---

## 3) File-Level Review Coverage

All tracked files were reviewed by category. The highest-risk categories and outcomes are:

- **Application domain & HTTP layer (`app/**`)**: reviewed; identified route/view mismatches, validation issues, and concurrency risk.
- **Routing (`routes/**`)**: reviewed; identified broken action mapping and public/private intent mismatch.
- **Persistence (`database/migrations/**`, factories/seeders)**: reviewed; schema mostly sane, but operational artifacts are tracked.
- **Views (`resources/views/**`)**: reviewed; confirmed missing templates for controller-returned views.
- **Tests (`tests/**`)**: reviewed; found permissive assertions masking failures.
- **Runtime/build artifacts (`storage/**`, `public/build/**`, `bootstrap/cache/**`)**: reviewed; should not be tracked for production-grade repo hygiene.
- **Config/dependency manifests (`config/**`, `composer.*`, `package.*`)**: reviewed; baseline okay, but governance/CI hardening missing.

---

## 4) Verification Commands Run

- `composer install --no-interaction --prefer-dist`
- `php artisan about`
- `php artisan route:list --except-vendor`
- `php artisan test` (1 failing test)
- `composer audit --no-interaction` (no advisories)
- `npm audit --audit-level=moderate` (0 vulnerabilities)
- `./vendor/bin/pint --test` (fails with widespread style drift)
- custom checks for missing views / tracked artifact counts / route-contract mismatches.

---

## 5) Production-Grade Remediation Plan (Strict)

## Phase 0 (Immediate blockers)
1. Add `.gitignore` and remove tracked secrets/artifacts from version control.
2. Rotate all potentially exposed credentials (at minimum `APP_KEY` lifecycle review + environment secret refresh).
3. Implement missing view templates or adjust controllers/routes to existing templates.
4. Add `BookingController::create()` or remove route.

## Phase 1 (Correctness)
1. Unify offer validity semantics (`>` vs `>=`) via explicit product rule and apply consistently.
2. Split store/update requests or implement `Rule::unique(...)->ignore($model->id)` for updates.
3. Fix tests to fail on server errors; remove permissive `[200,500]` acceptance.

## Phase 2 (Scalability & safety)
1. Protect booking creation with transactional isolation / row-level locking strategy.
2. Replace manual page-1..10 cache busting with tag-based or key-indexed invalidation.
3. Add CSP/HSTS strategy and deploy-time security configuration policy.

## Phase 3 (Governance)
1. Add CI pipeline: lint, unit/feature tests, static checks, build.
2. Add architecture + operations docs (incident, backup, rollback, secrets handling).
3. Add environment parity checks for staging vs production.

---

## 6) Current Commercial Risk Posture

- **Security risk:** High (secret handling + tracked env/runtime artifacts).
- **Availability risk:** High (core route 500 paths).
- **Quality risk:** High (tests allow 500, style drift, missing CI).
- **Data correctness risk:** Medium-High (booking concurrency edge case).

**Final verdict:** hardening is required before customer-facing production launch.
