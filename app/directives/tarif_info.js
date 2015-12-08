App.directive('tarifInfo', function() {

	// Tarif adress database limit list
var _TARIFS = {
	'B': {
		'name': 'Базовый',
		'limit': {
			'email': null,
			'sms': null
		},
		'showChange': 0
	},
    'R': {
		'name': 'Расширеный',
		'limit': {
			'email': null,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'N': {
		'name': 'Начальный',
		'limit': {
			'email': null,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'O': {
		'name': 'Оптимальный',
		'limit': {
			'email': null,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'P': {
		'name': 'Профессиональный',
		'limit': {
			'email': null,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'E': {
		'name': 'Эксперт',
		'limit': {
			'email': null,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'V': {
		'name': 'Премиум',
		'limit': {
			'email': null,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'S': {
		'name': 'Свои',
		'limit': {
			'email': null,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'F': {
		'name': 'Старт',
		'limit': {
			'email': 200,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'U': {
		'name': 'Т1',
		'limit': {
			'email': 2000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'Q': {
		'name': 'Т2',
		'limit': {
			'email': 10000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'X': {
		'name': 'Т3',
		'limit': {
			'email': 20000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'Y': {
		'name': 'Т4',
		'limit': {
			'email': 35000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'Z': {
		'name': 'Т5',
		'limit': {
			'email': 50000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'T': {
		'name': 'Тестовый',
		'limit': {
			'email': null,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
	'trial': {
		'name': 'Триал',
		'limit': {
			'email': null,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
	'B1': {
		'name': 'Бизнес 1',
		'id': 'Sendsay_B1_fee',
		'limit': {
			'email': 1000,
			'sms': null
		},
		'price': 750,
		'showChange': 1
	},
	'B2': {
		'name': 'Бизнес 2',
		'id': 'Sendsay_B2_fee',
		'limit': {
			'email': 2500,
			'sms': null
		},
		'price': 1300,
		'showChange': 1
	},
	'B5': {
		'name': 'Бизнес 5',
		'id': 'Sendsay_B5_fee',
		'limit': {
			'email': 5000,
			'sms': null
		},
		'price': 2000,
		'showChange': 1
	},
	'B10': {
		'name': 'Бизнес 10',
		'id': 'Sendsay_B10_fee',
		'limit': {
			'email': 10000,
			'sms': null
		},
		'price': 3300,
		'showChange': 1
	},
	'B25': {
		'name': 'Бизнес 25',
		'id': 'Sendsay_B25_fee',
		'limit': {
			'email': 25000,
			'sms': null
		},
		'price': 6500,
		'showChange': 1
	},
	'B50': {
		'name': 'Бизнес 50',
		'id': 'Sendsay_B50_fee',
		'limit': {
			'email': 50000,
			'sms': null
		},
		'price': 10300,
		'showChange': 1
	},
    'I': {
		'name': 'Индивидуальный',
		'limit': {
			'email': 0,
			'sms': null
		},
		'price': null,
		'showChange': 1
	},
    
    'T1': {
		'name': 'Т1',
		'limit': {
			'email': 2000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'T2': {
		'name': 'Т2',
		'limit': {
			'email': 10000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'T3': {
		'name': 'Т3',
		'limit': {
			'email': 20000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'T4': {
		'name': 'Т4',
		'limit': {
			'email': 35000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	},
    'T5': {
		'name': 'Т5',
		'limit': {
			'email': 50000,
			'sms': null
		},
		'price': 0,
		'showChange': 0
	}
};


	// Runs during compile
	return {
		// name: '',
		// priority: 1,
		// terminal: true,
		scope: {}, // {} = isolate, true = child, false/undefined = no change
		// controller: function($scope, $element, $attrs, $transclude) {},
		// require: 'ngModel', // Array = multiple requires, ? = optional, ^ = check parent elements
		restrict: 'E', // E = Element, A = Attribute, C = Class, M = Comment
		// template: '{{name}}',
		// templateUrl: '',
		replace: true,
		// transclude: true,
		// compile: function(tElement, tAttrs, function transclude(function(scope, cloneLinkingFn){ return function linking(scope, elm, attrs){}})),
		link: function($scope, iElm, iAttrs, controller) {
			var code = iAttrs.code || false,
				option = iAttrs.option || 'name';
			/*
			if(angular.isUndefined(_TARIFS[code]) || angular.isUndefined(_TARIFS[code][option])) {
				iElm.text('Unknown');
				return ;
			}
			*/

			iElm.text(_.get(_TARIFS, [ code, option ], 'Unknown'));	
		
		}
	};
});