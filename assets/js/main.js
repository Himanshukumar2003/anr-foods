const data = {
    India: {
      "Andhra Pradesh": [
        "Amaravati",
        "Visakhapatnam",
        "Vijayawada",
        "Guntur",
        "Nellore",
      ],
      "Arunachal Pradesh": [
        "Itanagar",
        "Naharlagun",
        "Pasighat",
        "Tezpur",
        "Ziro",
      ],
      Delhi: ["Central Delhi", "South Delhi", "North Delhi", "East Delhi", "West Delhi", "Shahdara", "Dwarka"],
      Assam: ["Guwahati", "Dispur", "Dibrugarh", "Silchar", "Jorhat"],
      Bihar: ["Patna", "Gaya", "Bhagalpur", "Muzaffarpur", "Darbhanga"],
      Chhattisgarh: ["Raipur", "Bhilai", "Durg", "Korba", "Bilaspur"],
      Goa: ["Panaji", "Margao", "Mapusa", "Ponda", "Vasco da Gama"],
      Gujarat: ["Gandhinagar", "Ahmedabad", "Surat", "Vadodara", "Rajkot"],
      Haryana: ["Chandigarh", "Gurugram", "Faridabad", "Ambala", "Hisar"],
      "Himachal Pradesh": [
        "Shimla",
        "Dharamshala",
        "Kullu",
        "Manali",
        "Solan",
      ],
      Jharkhand: ["Ranchi", "Jamshedpur", "Dhanbad", "Bokaro", "Deoghar"],
      Karnataka: ["Bengaluru", "Mysuru", "Mangalore", "Hubli", "Dharwad"],
      Kerala: [
        "Thiruvananthapuram",
        "Kochi",
        "Kozhikode",
        "Kollam",
        "Malappuram",
      ],
      "Madhya Pradesh": [
        "Bhopal",
        "Indore",
        "Gwalior",
        "Jabalpur",
        "Ujjain",
      ],
      Maharashtra: ["Mumbai", "Pune", "Nagpur", "Nashik", "Aurangabad"],
      Manipur: [
        "Imphal",
        "Thoubal",
        "Kakching",
        "Churachandpur",
        "Bishnupur",
      ],
      Meghalaya: ["Shillong", "Tura", "Jowai", "Nongstoin", "Williamnagar"],
      Mizoram: ["Aizawl", "Lunglei", "Saiha", "Champhai", "Kolasib"],
      Nagaland: ["Kohima", "Dimapur", "Mokokchung", "Wokha", "Tuensang"],
      Odisha: [
        "Bhubaneswar",
        "Cuttack",
        "Berhampur",
        "Rourkela",
        "Sambalpur",
      ],
      Punjab: [
        "Chandigarh",
        "Amritsar",
        "Ludhiana",
        "Jalandhar",
        "Patiala",
      ],
      Rajasthan: ["Jaipur", "Udaipur", "Jodhpur", "Ajmer", "Bikaner"],
      Sikkim: ["Gangtok", "Namchi", "Mangan", "Gyalshing", "Pakyong"],
      "Tamil Nadu": [
        "Chennai",
        "Coimbatore",
        "Madurai",
        "Tiruchirappalli",
        "Salem",
      ],
      Telangana: [
        "Hyderabad",
        "Warangal",
        "Nizamabad",
        "Khammam",
        "Karimnagar",
      ],
      Tripura: ["Agartala", "Udaipur", "Dharmanagar", "Ambassa", "Belonia"],
      "Uttar Pradesh": [
        "Lucknow",
        "Kanpur",
        "Agra",
        "Varanasi",
        "Ghaziabad",
      ],
      Uttarakhand: [
        "Dehradun",
        "Haridwar",
        "Nainital",
        "Rudrapur",
        "Roorkee",
      ],
      "West Bengal": [
        "Kolkata",
        "Siliguri",
        "Durgapur",
        "Asansol",
        "Howrah",
      ],
    },
  };

  const stateSelect = document.getElementById("stateSelect");
  const citySelect = document.getElementById("citySelect");

  function populateStates() {
    stateSelect.innerHTML = '<option value="Select State" selected="">Select State *</option>';
    citySelect.innerHTML = '<option value="Select City" selected="">Select City *</option>';

    Object.keys(data["India"]).forEach((state) => {
      let option = new Option(state, state);
      stateSelect.add(option);
    });
  }

  function populateCities() {
    citySelect.innerHTML = '<option value="Select City" selected="">Select City</option>';
    const selectedState = stateSelect.value;

    if (selectedState && selectedState in data["India"]) {
      data["India"][selectedState].forEach((city) => {
        let option = new Option(city, city);
        citySelect.add(option);
      });
    }
  }
  populateStates();

  stateSelect.addEventListener("change", populateCities);