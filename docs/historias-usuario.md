# Polarix User Stories

These stories describe functionality without technical implementation details.

## US-01 — Sign in and access by role

**As a** registered user, **I want to** sign in with my credentials, **so that** I can access the functions allowed for my role.

**Priority:** High  
**Dependencies:** Registered users and defined roles.

**Acceptance criteria:**

- The user is asked for an email and password.
- Valid credentials allow access.
- Invalid credentials deny access and show a clear message.
- The session expires after the inactivity period defined by the team.
- Signing out makes private functions unavailable.

**Business rules:** Only registered users may sign in. Available options depend on the user's role.

## US-02 — Manage products

**As a** manager, **I want to** create, update, view, and deactivate products, **so that** the store catalog remains accurate.

**Priority:** High  
**Dependencies:** US-01 and available product categories.

**Acceptance criteria:**

- The manager can create, update, and deactivate products.
- Each product has a name, price, category, stock quantity, and minimum level.
- Negative prices and quantities are rejected.
- Deactivated products cannot be selected for a sale.

**Business rules:** Only the manager may manage products. A product with sales cannot be deleted; it must be deactivated.

## US-03 — Register a sale

**As an** employee, **I want to** record the products and quantities sold, **so that** I can charge the customer and keep stock accurate.

**Priority:** High  
**Dependencies:** US-01, active products, and available stock.

**Acceptance criteria:**

- Active products and available quantities can be selected.
- A quantity greater than the available stock is rejected.
- The total, payment received, and change are calculated.
- A sale cannot be confirmed when payment is insufficient.
- Confirming a sale records the responsible employee and updates stock.

**Business rules:** The employee must have an active session. A confirmed sale cannot be changed without manager authorization.

## US-04 — Check inventory

**As a** manager, **I want to** view current stock and minimum levels, **so that** I can identify products that need replenishment.

**Priority:** High  
**Dependencies:** US-02 and confirmed sales or deliveries.

**Acceptance criteria:**

- Current stock is displayed for each product.
- Products at or below their minimum level are identified.
- Sales decrease stock and deliveries increase it.

**Business rules:** Stock cannot become negative. Only confirmed operations affect the displayed quantity.

## US-05 — Request replenishment

**As a** manager, **I want to** request products from a supplier and track the request status, **so that** the store remains supplied.

**Priority:** Medium  
**Dependencies:** US-01, US-02, and registered suppliers.

**Acceptance criteria:**

- A request includes a supplier, product, quantity, and date.
- The requested quantity must be greater than zero.
- A new request starts as pending.
- The request status can be viewed.
- Receiving the delivery increases the product stock.

**Business rules:** Only the manager may create or change requests. A cancelled request cannot be marked as received.

## US-06 — Close the cash register

**As a** manager, **I want to** compare expected cash with counted cash, **so that** I can verify the sales for the period.

**Priority:** High  
**Dependencies:** US-03 and confirmed sales for the selected period.

**Acceptance criteria:**

- The sales total for the selected period is calculated.
- Counted cash can be entered.
- Any difference, shortage, or surplus is displayed.
- The closing records the date, responsible person, and result.
- A confirmed closing cannot be changed without authorization.

**Business rules:** Only the manager may confirm a closing. Each period may have one confirmed closing.
