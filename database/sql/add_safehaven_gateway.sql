-- Add Safe Haven (Billway) payment gateway
INSERT INTO `payment_gateways` (`sort_id`, `name`, `alias`, `logo`, `fees`, `credentials`, `parameters`, `is_manual`, `instructions`, `mode`, `status`) 
VALUES (
    14, 
    'Safe Haven', 
    'billway', 
    'images/payment-gateways/billway.png', 
    0, 
    '{"api_key":null,"webhook_secret":null}', 
    '[{"type":"route","label":"Webhook Endpoint","content":"payments/webhooks/billway"}]', 
    0, 
    NULL, 
    'sandbox', 
    0
); 