-- Adds the roast-level meter data.
-- Run AFTER schema.sql and seed.sql. Safe to run again.
-- 1 = Light, 2 = Light-medium, 3 = Medium, 4 = Medium-dark, 5 = Dark
-- NULL = no meter (not a single coffee, e.g. drinking chocolate or a sampler)

ALTER TABLE products
ADD COLUMN IF NOT EXISTS roast_level SMALLINT
CHECK (roast_level BETWEEN 1 AND 5);

UPDATE products SET roast_level = CASE product_name
    WHEN 'Ethiopia Beyene Dori'      THEN 1
    WHEN 'Ethiopia Sidama'           THEN 1
    WHEN 'Breakfast Blend'           THEN 1
    WHEN 'Guatemala Huehuetenango'   THEN 2
    WHEN 'Hawaiian Kona Peaberry'    THEN 2
    WHEN 'Colombia La Florida'       THEN 3
    WHEN 'Costa Rica Tarrazu'        THEN 3
    WHEN 'Nepal Himalayan Roast'     THEN 3
    WHEN 'Coastal House Blend'       THEN 3
    WHEN 'East Coast Medium Roast'   THEN 3
    WHEN 'Everyday House Coffee'     THEN 3
    WHEN 'Nutty Flavored Blend'      THEN 3
    WHEN 'Classic Roasters Blend'    THEN 4
    WHEN 'Espresso Blend'            THEN 4
    WHEN 'Diner Roast + Mug Bundle'  THEN 4
    WHEN 'Vietnam Robusta Honey'     THEN 5
    WHEN 'Espresso Roast'            THEN 5
    ELSE NULL
END;