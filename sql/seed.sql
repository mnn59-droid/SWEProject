-- Sample products for the coffee shop. Run once, after schema.sql.
-- Images live in public/assets/img/products/

INSERT INTO products (product_name, description, price, stock, category, image_patch) VALUES
-- Single Origin
('Guatemala Huehuetenango',   'Pacamara beans from the Guatemalan highlands. Juicy, sweet and bright. 12 oz whole bean.',          19.50, 18, 'Single Origin', 'img/products/guatemala-huehuetenango.jpg'),
('Ethiopia Beyene Dori',      'Light roast with notes of red currant, tropical fruit and white chocolate. 12 oz whole bean.',     18.50, 25, 'Single Origin', 'img/products/ethiopia-beyene-dori.jpg'),
('Ethiopia Sidama',           'Anaerobic-processed heirloom beans with passion fruit and strawberry notes. Great for filter. 8 oz.', 21.00, 12, 'Single Origin', 'img/products/ethiopia-sidama.jpg'),
('Colombia La Florida',       'Medium roast with black cherry, chocolate and almond toffee. Syrupy body. 12 oz whole bean.',      17.00, 30, 'Single Origin', 'img/products/colombia-la-florida.jpg'),
('Costa Rica Tarrazu',        'Single-estate Caturra and Catuai from Tarrazu. Sweet dark chocolate flavor. 12 oz whole bean.',    18.00, 20, 'Single Origin', 'img/products/costa-rica-tarrazu.jpg'),
('Nepal Himalayan Roast',     '100% Arabica grown in the Himalayan foothills. Smooth and mellow. 250 g ground.',                  16.50, 15, 'Single Origin', 'img/products/nepal-himalayan-roast.jpg'),
('Vietnam Robusta Honey',     'Honey-processed Robusta from Bao Loc. Bold and rich, made for a phin filter. 500 g whole bean.',   15.00, 22, 'Single Origin', 'img/products/vietnam-robusta-honey.jpg'),
('Hawaiian Kona Peaberry',    '100% Kona peaberry from a single estate. Rare, smooth and lightly sweet. 14 oz whole bean.',       49.00,  6, 'Single Origin', 'img/products/kona-peaberry.jpg'),
-- Blends
('Breakfast Blend',           'Light roast that is fruity and floral with a milk chocolate finish. 250 g whole bean.',            14.50, 35, 'Blends',        'img/products/breakfast-blend.jpg'),
('Coastal House Blend',       'Our everyday medium roast. Balanced, chocolatey and easy to drink. 12 oz whole bean.',             14.99, 40, 'Blends',        'img/products/coastal-house-blend.jpg'),
('East Coast Medium Roast',   'Organic, fair trade medium roast with a clean, nutty finish. 1 lb whole bean.',                    16.99, 28, 'Blends',        'img/products/east-coast-medium-roast.jpg'),
('Classic Roasters Blend',    'Full-bodied blend with notes of caramel and dark fruit. 12 oz whole bean.',                        17.50,  0, 'Blends',        'img/products/classic-roasters-blend.jpg'),
('Everyday House Coffee',     'Simple, reliable medium roast in whole bean or ground. 8 oz pouch.',                               11.99, 45, 'Blends',        'img/products/everyday-house-coffee.jpg'),
-- Espresso
('Espresso Blend',            'Dark chocolate, roasted peanut and caramel. Thick crema and great with milk. 250 g whole bean.',   16.00, 24, 'Espresso',      'img/products/espresso-blend.jpg'),
('Espresso Roast',            'Classic espresso roast with a sweet, syrupy shot. 12 oz whole bean.',                              15.50, 20, 'Espresso',      'img/products/espresso-roast.jpg'),
-- Specialty
('Nutty Flavored Blend',      'Medium roast with toasted hazelnut and praline flavor. 12 oz ground.',                             13.99, 18, 'Specialty',     'img/products/nutty-flavored-blend.jpg'),
('Drinking Chocolate',        '42% cocoa drinking chocolate. Whisk into hot milk for a rich cup. 1 kg bag.',                     24.00, 10, 'Specialty',     'img/products/drinking-chocolate.jpg'),
('Diner Roast + Mug Bundle',  'A 12 oz bag of our diner-style roast plus a retro ceramic mug.',                                   29.99,  8, 'Specialty',     'img/products/diner-roast-mug-bundle.jpg'),
('Roaster''s Sampler',        'Three 250 g bags from Costa Rica, Kenya and Nicaragua. A good way to explore new origins.',       44.00,  5, 'Specialty',     'img/products/roasters-sampler.jpg');