<?php

return [

    'state' => [
      'all' => [
        '01' => 'Johor',
        '02' => 'Kedah',
        '03' => 'Kelantan',
        '04' => 'Malacca',
        '05' => 'Negeri Sembilan',
        '06' => 'Pahang',
        '07' => 'Penang',
        '08' => 'Perak',
        '09' => 'Perlis',
        '10' => 'Selangor',
        '11' => 'Terengganu',
        '12' => 'Sabah',
        '13' => 'Sarawak',
        '14' => 'WP-KUALA LUMPUR',
        '15' => 'WP-LABUAN',
        '16' => 'WP-PUTRAJAYA',
      ]
    ],

    'license' => [
      'all' => [
        'A','A1',
        'B','B1','B2',
        'C',
        'D','DA',
        'E','E1','E2',
        'F',
        'G',
        'H',
        'I',
        'M'
      ]
    ],

    'contract' => [
      'block' => '0xb09e33e5f9f6a5038c4fd12ccbed41bc6048cbfd',
      'abi' => '[
      	{
      		"constant": false,
      		"inputs": [
      			{
      				"name": "_nric",
      				"type": "bytes32"
      			},
      			{
      				"name": "citizenInfo",
      				"type": "bytes32[]"
      			}
      		],
      		"name": "registerCitizen",
      		"outputs": [],
      		"payable": false,
      		"stateMutability": "nonpayable",
      		"type": "function"
      	},
      	{
      		"constant": false,
      		"inputs": [
      			{
      				"name": "_nric",
      				"type": "bytes32"
      			},
      			{
      				"name": "citizenInfo",
      				"type": "bytes32[]"
      			}
      		],
      		"name": "updateCitizen",
      		"outputs": [],
      		"payable": false,
      		"stateMutability": "nonpayable",
      		"type": "function"
      	},
      	{
      		"constant": true,
      		"inputs": [
      			{
      				"name": "_nric",
      				"type": "bytes32"
      			}
      		],
      		"name": "checkIsCitizenExists",
      		"outputs": [
      			{
      				"name": "isExist",
      				"type": "bool"
      			}
      		],
      		"payable": false,
      		"stateMutability": "view",
      		"type": "function"
      	},
      	{
      		"constant": true,
      		"inputs": [
      			{
      				"name": "_nric",
      				"type": "bytes32"
      			}
      		],
      		"name": "getAddress1",
      		"outputs": [
      			{
      				"name": "address_1",
      				"type": "bytes32"
      			}
      		],
      		"payable": false,
      		"stateMutability": "view",
      		"type": "function"
      	},
      	{
      		"constant": true,
      		"inputs": [
      			{
      				"name": "_nric",
      				"type": "bytes32"
      			}
      		],
      		"name": "getAddress2",
      		"outputs": [
      			{
      				"name": "address_2",
      				"type": "bytes32"
      			}
      		],
      		"payable": false,
      		"stateMutability": "view",
      		"type": "function"
      	},
      	{
      		"constant": true,
      		"inputs": [
      			{
      				"name": "_nric",
      				"type": "bytes32"
      			}
      		],
      		"name": "getCity",
      		"outputs": [
      			{
      				"name": "city",
      				"type": "bytes32"
      			}
      		],
      		"payable": false,
      		"stateMutability": "view",
      		"type": "function"
      	},
      	{
      		"constant": true,
      		"inputs": [
      			{
      				"name": "_nric",
      				"type": "bytes32"
      			}
      		],
      		"name": "getDOB",
      		"outputs": [
      			{
      				"name": "dob",
      				"type": "bytes32"
      			}
      		],
      		"payable": false,
      		"stateMutability": "view",
      		"type": "function"
      	},
      	{
      		"constant": true,
      		"inputs": [
      			{
      				"name": "_nric",
      				"type": "bytes32"
      			}
      		],
      		"name": "getDriverExpiryDate",
      		"outputs": [
      			{
      				"name": "driver_expiry_date",
      				"type": "bytes32"
      			}
      		],
      		"payable": false,
      		"stateMutability": "view",
      		"type": "function"
      	},
      	{
      		"constant": true,
      		"inputs": [
      			{
      				"name": "_nric",
      				"type": "bytes32"
      			}
      		],
      		"name": "getDrivingLicense",
      		"outputs": [
      			{
      				"name": "driving_license",
      				"type": "bytes32"
      			}
      		],
      		"payable": false,
      		"stateMutability": "view",
      		"type": "function"
      	},
      	{
      		"constant": true,
      		"inputs": [
      			{
      				"name": "_nric",
      				"type": "bytes32"
      			}
      		],
      		"name": "getEmail",
      		"outputs": [
      			{
      				"name": "email",
      				"type": "bytes32"
      			}
      		],
      		"payable": false,
      		"stateMutability": "view",
      		"type": "function"
      	},
      	{
      		"constant": true,
      		"inputs": [
      			{
      				"name": "_nric",
      				"type": "bytes32"
      			}
      		],
      		"name": "getGender",
      		"outputs": [
      			{
      				"name": "gender",
      				"type": "bytes32"
      			}
      		],
      		"payable": false,
      		"stateMutability": "view",
      		"type": "function"
      	},
      	{
      		"constant": true,
      		"inputs": [
      			{
      				"name": "_nric",
      				"type": "bytes32"
      			}
      		],
      		"name": "getName",
      		"outputs": [
      			{
      				"name": "name",
      				"type": "bytes32"
      			}
      		],
      		"payable": false,
      		"stateMutability": "view",
      		"type": "function"
      	},
      	{
      		"constant": true,
      		"inputs": [],
      		"name": "getNumOfCitizens",
      		"outputs": [
      			{
      				"name": "num",
      				"type": "uint256"
      			}
      		],
      		"payable": false,
      		"stateMutability": "view",
      		"type": "function"
      	},
      	{
      		"constant": true,
      		"inputs": [
      			{
      				"name": "_nric",
      				"type": "bytes32"
      			}
      		],
      		"name": "getRace",
      		"outputs": [
      			{
      				"name": "race",
      				"type": "bytes32"
      			}
      		],
      		"payable": false,
      		"stateMutability": "view",
      		"type": "function"
      	},
      	{
      		"constant": true,
      		"inputs": [
      			{
      				"name": "_nric",
      				"type": "bytes32"
      			}
      		],
      		"name": "getState",
      		"outputs": [
      			{
      				"name": "state",
      				"type": "bytes32"
      			}
      		],
      		"payable": false,
      		"stateMutability": "view",
      		"type": "function"
      	},
      	{
      		"constant": true,
      		"inputs": [
      			{
      				"name": "_nric",
      				"type": "bytes32"
      			}
      		],
      		"name": "getZIP",
      		"outputs": [
      			{
      				"name": "zip",
      				"type": "bytes32"
      			}
      		],
      		"payable": false,
      		"stateMutability": "view",
      		"type": "function"
      	},
      	{
      		"constant": true,
      		"inputs": [],
      		"name": "numOfCitizens",
      		"outputs": [
      			{
      				"name": "",
      				"type": "uint256"
      			}
      		],
      		"payable": false,
      		"stateMutability": "view",
      		"type": "function"
      	}
      ]'
    ]

];
