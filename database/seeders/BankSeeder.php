<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $createMultipleUsers = [
        //     ['9mobile 9Payment Service Bank', '9mobile-9payment-service-bank-ng', '120001', '120001', '', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Abbey Mortgage Bank', 'abbey-mortgage-bank', '801', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Above Only MFB', 'above-only-mfb', '51204', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Abulesoro MFB', 'abulesoro-mfb-ng', '51312', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Access Bank', 'access-bank', '044', '044150149', 'emandate', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Access Bank (Diamond)', 'access-bank-diamond', '063', '063150162', 'emandate', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Accion Microfinance Bank', 'accion-microfinance-bank-ng', '602', '', 'emandate', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Ahmadu Bello University Microfinance Bank', 'ahmadu-bello-university-microfinance-bank-ng', '50036', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Airtel Smartcash PSB', 'airtel-smartcash-psb-ng', '120004', '120004', '', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['ALAT by WEMA', 'alat-by-wema', '035A', '035150103', 'emandate', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Amju Unique MFB', 'amju-unique-mfb', '50926', '511080896', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Aramoko MFB', 'aramoko-mfb', '50083', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['ASO Savings and Loans', 'asosavings', '401', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Astrapolaris MFB LTD', 'astrapolaris-mfb', 'MFB50094', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Bainescredit MFB', 'bainescredit-mfb', '51229', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Bowen Microfinance Bank', 'bowen-microfinance-bank', '50931', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Carbon', 'carbon', '565', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['CEMCS Microfinance Bank', 'cemcs-microfinance-bank', '50823', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Chanelle Microfinance Bank Limited', 'chanelle-microfinance-bank-limited-ng', '50171', '50171', '', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Citibank Nigeria', 'citibank-nigeria', '023', '023150005', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Corestep MFB', 'corestep-mfb', '50204', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Coronation Merchant Bank', 'coronation-merchant-bank', '559', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Crescent MFB', 'crescent-mfb', '51297', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Dot Microfinance Bank', 'dot-microfinance-bank-ng', '50162', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Ecobank Nigeria', 'ecobank-nigeria', '050', '050150010', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Ekimogun MFB', 'ekimogun-mfb-ng', '50263', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Ekondo Microfinance Bank', 'ekondo-microfinance-bank-ng', '098', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Eyowo', 'eyowo', '50126', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Fairmoney Microfinance Bank', 'fairmoney-microfinance-bank-ng', '51318', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Fidelity Bank', 'fidelity-bank', '070', '070150003', 'emandate', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Firmus MFB', 'firmus-mfb', '51314', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['First Bank of Nigeria', 'first-bank-of-nigeria', '011', '011151003', 'ibank', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['First City Monument Bank', 'first-city-monument-bank', '214', '214150018', 'emandate', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['FSDH Merchant Bank Limited', 'fsdh-merchant-bank-limited', '501', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Gateway Mortgage Bank LTD', 'gateway-mortgage-bank', '812', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Globus Bank', 'globus-bank', '00103', '103015001', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['GoMoney', 'gomoney', '100022', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Goodnews Microfinance Bank', 'goodnews-microfinance-bank-ng', '50739', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Greenwich Merchant Bank', 'greenwich-merchant-bank-ng', '562', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Guaranty Trust Bank', 'guaranty-trust-bank', '058', '058152036', 'ibank', 1, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Hackman Microfinance Bank', 'hackman-microfinance-bank', '51251', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Hasal Microfinance Bank', 'hasal-microfinance-bank', '50383', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Heritage Bank', 'heritage-bank', '030', '030159992', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['HopePSB', 'hopepsb-ng', '120002', '120002', '', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Ibile Microfinance Bank', 'ibile-mfb', '51244', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Ikoyi Osun MFB', 'ikoyi-osun-mfb', '50439', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Ilaro Poly Microfinance Bank', 'ilaro-poly-microfinance-bank-ng', '50442', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Infinity MFB', 'infinity-mfb', '50457', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Jaiz Bank', 'jaiz-bank', '301', '301080020', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Kadpoly MFB', 'kadpoly-mfb', '50502', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Keystone Bank', 'keystone-bank', '082', '082150017', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Kredi Money MFB LTD', 'kredi-money-mfb', '50200', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Kuda Bank', 'kuda-bank', '50211', '', 'digitalbankmandate', 1, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Lagos Building Investment Company Plc.', 'lbic-plc', '90052', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Links MFB', 'links-mfb', '50549', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Living Trust Mortgage Bank', 'living-trust-mortgage-bank', '031', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Lotus Bank', 'lotus-bank', '303', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Mayfair MFB', 'mayfair-mfb', '50563', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Mint MFB', 'mint-mfb', '50304', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['MTN Momo PSB', 'mtn-momo-psb-ng', '120003', '120003', '', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Paga', 'paga', '100002', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['PalmPay', 'palmpay', '999991', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Parallex Bank', 'parallex-bank', '104', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Parkway - ReadyCash', 'parkway-ready-cash', '311', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Paycom', 'paycom', '999992', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Petra Mircofinance Bank Plc', 'petra-microfinance-bank-plc', '50746', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Polaris Bank', 'polaris-bank', '076', '076151006', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Polyunwana MFB', 'polyunwana-mfb-ng', '50864', 'null', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['PremiumTrust Bank', 'premiumtrust-bank-ng', '105', '000031', '', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Providus Bank', 'providus-bank', '101', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['QuickFund MFB', 'quickfund-mfb', '51293', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Rand Merchant Bank', 'rand-merchant-bank', '502', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Refuge Mortgage Bank', 'refuge-mortgage-bank', '90067', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Rubies MFB', 'rubies-mfb', '125', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Safe Haven MFB', 'safe-haven-mfb-ng', '51113', '51113', '', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Safe Haven Microfinance Bank Limited', 'safe-haven-microfinance-bank-limited-ng', '951113', '', 'emandate', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Shield MFB', 'shield-mfb-ng', '50582', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Solid Rock MFB', 'solid-rock-mfb', '50800', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Sparkle Microfinance Bank', 'sparkle-microfinance-bank', '51310', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Stanbic IBTC Bank', 'stanbic-ibtc-bank', '221', '221159522', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Standard Chartered Bank', 'standard-chartered-bank', '068', '068150015', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Stellas MFB', 'stellas-mfb', '51253', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Sterling Bank', 'sterling-bank', '232', '232150016', 'emandate', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Suntrust Bank', 'suntrust-bank', '100', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Supreme MFB', 'supreme-mfb-ng', '50968', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['TAJ Bank', 'taj-bank', '302', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Tanadi Microfinance Bank', 'tanadi-microfinance-bank-ng', '090560', '', 'ibank', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Tangerine Money', 'tangerine-money', '51269', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['TCF MFB', 'tcf-mfb', '51211', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Titan Bank', 'titan-bank', '102', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Titan Paystack', 'titan-paystack', '100039', '', '', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Uhuru MFB', 'uhuru-mfb-ng', 'MFB51322', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Unaab Microfinance Bank Limited', 'unaab-microfinance-bank-limited-ng', '50870', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Unical MFB', 'unical-mfb', '50871', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Unilag Microfinance Bank', 'unilag-microfinance-bank-ng', '51316', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Union Bank of Nigeria', 'union-bank-of-nigeria', '032', '032080474', 'emandate', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['United Bank For Africa', 'united-bank-for-africa', '033', '033153513', 'emandate', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Unity Bank', 'unity-bank', '215', '215154097', 'emandate', 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['VFD Microfinance Bank Limited', 'vfd', '566', '', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Wema Bank', 'wema-bank', '035', '035150103', NULL, 0, 1, 'Nigeria', 'NGN', 'nuban'],
        //     ['Zenith Bank', 'zenith-bank', '057', '057150013', 'emandate', 1, 1, 'Nigeria', 'NGN', 'nuban'],
        // ];

        // Bank::insert($createMultipleUsers);
        // if (!Schema::hasTable('banks')) {
        //     $bank = Bank::insert($createMultipleUsers);
        //     if (!$bank) {
        //         return false;
        //     }
        // }
    }
}
