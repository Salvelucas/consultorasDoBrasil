<?php get_header(); ?>
<?php
// Include the SDK
require_once('mail/Infusionsoft/infusionsoft.php');
 $sellers = dokan_get_sellers($limit, $offset);
  foreach ($sellers['users'] as $seller){
    $store_info = dokan_get_store_info($seller->ID);
        $nomeLoja         = $store_info['store_name'];
        $email            = $seller->user_email;
        $nome             = $seller->display_name;
        $marca            = $store_info['brands'];
        $phone            = $store_info['phone'];

        if (isset($store_info['address']) && !empty($store_info['address'])) {
            $endereco     = $store_info['address'];
            $estado       = $endereco['state'];
            $pais         = $endereco['country'];
            $cidade       = $endereco['city'];
            $cep          = $endereco['zip'];
            $endereco     = $endereco['street_1'];
          }
        // Create a new contact object
        $contact = new Infusionsoft_Contact();
        // Set the contact fields
        $contact->FirstName =  $nome;
        $contact->Email = $email;
        $contact->Company =  $nomeLoja;
        $contact->JobTitle = $marca;
        $contact->City = $cidade;
        $contact->State = $estado;
        $contact->PostalCode = $cep;
        $contact->Country = 'Brazil';
        $contact->StreetAddress1 = $endereco;
        $contact->Phone1 = $phone;
        $contact->CompanyID = '5029';
        //$contact->save();
}

?>
<?php get_footer(); ?>
