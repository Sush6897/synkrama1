<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            'Andaman and Nicobar Islands' => ['Port Blair'],
            'Andhra Pradesh' => ['Visakhapatnam', 'Vijayawada', 'Guntur', 'Nellore', 'Kurnool', 'Kakinada', 'Rajahmundry', 'Tirupati', 'Anantapur', 'Kadapa'],
            'Arunachal Pradesh' => ['Itanagar', 'Naharlagun', 'Tawang', 'Pasighat', 'Roing', 'Ziro', 'Along', 'Daporijo', 'Yingkiong', 'Anini'],
            'Assam' => ['Guwahati', 'Silchar', 'Dibrugarh', 'Jorhat', 'Nagaon', 'Tinsukia', 'Tezpur', 'Sivasagar', 'Bongaigaon', 'Goalpara'],
            'Bihar' => ['Patna', 'Gaya', 'Bhagalpur', 'Muzaffarpur', 'Bihar Sharif', 'Darbhanga', 'Arrah', 'Begusarai', 'Katihar', 'Chhapra'],
            'Chandigarh' => ['Chandigarh'],
            'Chhattisgarh' => ['Raipur', 'Bhilai', 'Bilaspur', 'Korba', 'Durg', 'Raigarh', 'Rajnandgaon', 'Jagdalpur', 'Ambikapur', 'Dhamtari'],
            'Dadra and Nagar Haveli and Daman and Diu' => ['Daman', 'Silvassa'],
            'Delhi' => ['New Delhi', 'Delhi Cantt', 'Narela', 'Saket', 'Karol Bagh', 'Lajpat Nagar', 'Pitampura', 'Connaught Place', 'Chanakyapuri', 'Nizamuddin'],
            'Goa' => ['Panaji', 'Margao', 'Vasco da Gama', 'Ponda', 'Mapusa', 'Bicholim', 'Curchorem', 'Sancoale', 'Valpoi', 'Cuncolim'],
            'Gujarat' => ['Ahmedabad', 'Surat', 'Vadodara', 'Rajkot', 'Bhavnagar', 'Jamnagar', 'Junagadh', 'Gandhinagar', 'Anand', 'Bharuch'],
            'Haryana' => ['Faridabad', 'Gurgaon', 'Panipat', 'Ambala', 'Yamunanagar', 'Rohtak', 'Hisar', 'Karnal', 'Sonipat', 'Panchkula'],
            'Himachal Pradesh' => ['Shimla', 'Mandi', 'Solan', 'Dharamshala', 'Kullu', 'Chamba', 'Bilaspur', 'Nahan', 'Sirmaur', 'Una'],
            'Jharkhand' => ['Ranchi', 'Jamshedpur', 'Dhanbad', 'Bokaro Steel City', 'Deoghar', 'Phusro', 'Hazaribagh', 'Giridih', 'Ramgarh', 'Medininagar'],
            'Karnataka' => ['Bangalore', 'Mysore', 'Hubli-Dharwad', 'Mangalore', 'Belgaum', 'Gulbarga', 'Davanagere', 'Bellary', 'Bijapur', 'Shimoga'],
            'Kerala' => ['Thiruvananthapuram', 'Kochi', 'Kozhikode', 'Thrissur', 'Kollam', 'Palakkad', 'Alappuzha', 'Kannur', 'Kottayam', 'Manjeri'],
            // 'Ladakh' => ['Leh', 'Kargil'],
            'Lakshadweep' => ['Kavaratti', 'Agatti', 'Andrott', 'Amini', 'Kadmat', 'Kalpeni', 'Kilthan', 'Chetlat', 'Bitra', 'Kiltan'],
            'Madhya Pradesh' => ['Indore', 'Bhopal', 'Jabalpur', 'Gwalior', 'Ujjain', 'Sagar', 'Dewas', 'Satna', 'Ratlam', 'Rewa'],
            'Maharashtra' => ['Mumbai', 'Pune', 'Nagpur', 'Thane', 'Nashik', 'Aurangabad', 'Solapur', 'Bhiwandi', 'Amravati', 'Malegaon'],
            'Manipur' => ['Imphal', 'Thoubal', 'Lilong', 'Kakching', 'Ukhrul', 'Bishnupur', 'Senapati', 'Churachandpur', 'Chandel', 'Tamenglong'],
            'Meghalaya' => ['Shillong', 'Tura', 'Jowai', 'Nongpoh', 'Nongstoin', 'Baghmara', 'Williamnagar', 'Resubelpara', 'Khliehriat', 'Mairang'],
            'Mizoram' => ['Aizawl', 'Lunglei', 'Saiha', 'Champhai', 'Serchhip', 'Kolasib', 'Lawngtlai', 'Saitual', 'Khawzawl', 'Hnahthial'],
            'Nagaland' => ['Kohima', 'Dimapur', 'Mokokchung', 'Tuensang', 'Wokha', 'Zunheboto', 'Phek', 'Chumukedima', 'Chumukedima', 'Longleng'],
            'Odisha' => ['Bhubaneswar', 'Cuttack', 'Rourkela', 'Brahmapur', 'Sambalpur', 'Puri', 'Balasore', 'Bhadrak', 'Baripada', 'Jharsuguda'],
            'Puducherry' => ['Pondicherry', 'Karaikal', 'Mahe', 'Yanam', 'Ariankuppam', 'Ozhukarai', 'Villianur', 'Muthialpet', 'Nellithope', 'Mannadipet'],
            'Punjab' => ['Ludhiana', 'Amritsar', 'Jalandhar', 'Patiala', 'Bathinda', 'Hoshiarpur', 'Mohali', 'Batala', 'Pathankot', 'Moga'],
            'Rajasthan' => ['Jaipur', 'Jodhpur', 'Udaipur', 'Kota', 'Bikaner', 'Ajmer', 'Bhilwara', 'Alwar', 'Sikar', 'Pali'],
            'Sikkim' => ['Gangtok', 'Namchi', 'Mangan', 'Gyalshing', 'Singtam', 'Ravangla', 'Rangpo', 'Jorethang', 'Nayabazar', 'Naya Bazar'],
            'Tamil Nadu' => ['Chennai', 'Coimbatore', 'Madurai', 'Tiruchirappalli', 'Salem', 'Tiruppur', 'Erode', 'Vellore', 'Thoothukudi', 'Tirunelveli'],
            'Telangana' => ['Hyderabad', 'Warangal', 'Nizamabad', 'Khammam', 'Karimnagar', 'Ramagundam', 'Mahbubnagar', 'Nalgonda', 'Adilabad', 'Suryapet'],
            'Tripura' => ['Agartala', 'Udaipur', 'Dharmanagar', 'Kailasahar', 'Ambassa', 'Khowai', 'Belonia', 'Teliamura', 'Sabroom', 'Sonamura'],
            'Uttar Pradesh' => ['Lucknow', 'Kanpur', 'Ghaziabad', 'Agra', 'Varanasi', 'Meerut', 'Allahabad', 'Bareilly', 'Aligarh', 'Moradabad'],
            'Uttarakhand' => ['Dehradun', 'Haridwar', 'Roorkee', 'Haldwani', 'Rudrapur', 'Kashipur', 'Rishikesh', 'Nainital',  'Pithoragarh'],
            'West Bengal' => ['Kolkata', 'Howrah', 'Asansol', 'Siliguri', 'Durgapur', 'Bardhaman', 'English Bazar', 'Baharampur', 'Habra', 'Kharagpur'],
        ];
            // Add more states and cities as needed
        

        foreach ($cities as $state => $cityList) {
            $stateId = DB::table('states')->where('name', $state)->value('id');

            foreach ($cityList as $city) {
                DB::table('cities')->insert([
                    'name' => $city,
                    'state_id' => $stateId,
                ]);
            }
        }
    }
}
