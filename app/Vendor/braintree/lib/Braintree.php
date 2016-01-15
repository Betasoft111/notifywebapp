<?php
/**
 * Braintree PHP Library
 *
 * Braintree base class and initialization
 * Provides methods to child classes. This class cannot be instantiated.
 *
 *  PHP version 5
 *
 * @copyright  2014 Braintree, a division of PayPal, Inc.
 */


set_include_path(get_include_path() . PATH_SEPARATOR . realpath(dirname(__FILE__)));

require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Base.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Modification.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Instance.php');

require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/OAuthCredentials.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Address.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/AddressGateway.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/AddOn.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/AddOnGateway.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/AndroidPayCard.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/ApplePayCard.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/ClientToken.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/ClientTokenGateway.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/CoinbaseAccount.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Collection.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Configuration.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/CredentialsParser.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/CreditCard.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/CreditCardGateway.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Customer.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/CustomerGateway.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/CustomerSearch.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/DisbursementDetails.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Dispute.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Dispute/TransactionDetails.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Descriptor.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Digest.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Discount.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/DiscountGateway.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/IsNode.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/EuropeBankAccount.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/EqualityNode.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Exception.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Gateway.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Http.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/KeyValueNode.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Merchant.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/MerchantGateway.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/MerchantAccount.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/MerchantAccountGateway.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/MerchantAccount/BusinessDetails.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/MerchantAccount/FundingDetails.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/MerchantAccount/IndividualDetails.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/MerchantAccount/AddressDetails.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/MultipleValueNode.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/MultipleValueOrTextNode.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/OAuthGateway.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/PartialMatchNode.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Plan.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/PlanGateway.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/RangeNode.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/ResourceCollection.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/RiskData.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/ThreeDSecureInfo.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/SettlementBatchSummary.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/SettlementBatchSummaryGateway.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/SignatureService.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Subscription.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/SubscriptionGateway.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/SubscriptionSearch.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Subscription/StatusDetails.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/TextNode.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Transaction.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/TransactionGateway.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Disbursement.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/TransactionSearch.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/TransparentRedirect.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/TransparentRedirectGateway.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Util.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Version.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Xml.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Error/Codes.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Error/ErrorCollection.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Error/Validation.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Error/ValidationErrorCollection.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Exception/Authentication.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Exception/Authorization.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Exception/Configuration.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Exception/DownForMaintenance.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Exception/ForgedQueryString.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Exception/InvalidChallenge.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Exception/InvalidSignature.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Exception/NotFound.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Exception/ServerError.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Exception/SSLCertificate.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Exception/SSLCaFileNotFound.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Exception/Unexpected.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Exception/UpgradeRequired.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Exception/ValidationsFailed.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Result/CreditCardVerification.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Result/Error.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Result/Successful.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Test/CreditCardNumbers.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Test/MerchantAccount.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Test/TransactionAmounts.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Test/VenmoSdk.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Test/Nonces.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Transaction/AddressDetails.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Transaction/AndroidPayCardDetails.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Transaction/ApplePayCardDetails.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Transaction/CoinbaseDetails.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Transaction/EuropeBankAccountDetails.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Transaction/CreditCardDetails.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Transaction/PayPalDetails.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Transaction/CustomerDetails.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Transaction/StatusDetails.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Transaction/SubscriptionDetails.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/WebhookNotification.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/WebhookTesting.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Xml/Generator.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Xml/Parser.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/CreditCardVerification.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/CreditCardVerificationGateway.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/CreditCardVerificationSearch.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/PartnerMerchant.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/PayPalAccount.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/PayPalAccountGateway.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/PaymentMethod.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/PaymentMethodGateway.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/PaymentMethodNonce.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/PaymentMethodNonceGateway.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/PaymentInstrumentType.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/UnknownPaymentMethod.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Exception/TestOperationPerformedInProduction.php');
require_once('/home/abdevs/public_html/attendance/app/Vendor/braintree/lib/Braintree/Test/Transaction.php');

if (version_compare(PHP_VERSION, '5.4.0', '<')) {
    throw new Braintree_Exception('PHP version >= 5.4.0 required');
}


function requireDependencies() {
    $requiredExtensions = array('xmlwriter', 'openssl', 'dom', 'hash', 'curl');
    foreach ($requiredExtensions AS $ext) {
        if (!extension_loaded($ext)) {
            throw new Braintree_Exception('The Braintree library requires the ' . $ext . ' extension.');
        }
    }
}

requireDependencies();

