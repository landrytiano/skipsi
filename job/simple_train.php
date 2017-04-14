<?php

$num_input = 5;
$num_output = 7;
$num_layers = 3;
$num_neurons_hidden = 5;
$desired_error = 0.000001;
$max_epochs = 50000000000;
$epochs_between_reports = 2000;

$ann = fann_create_standard($num_layers, $num_input, $num_neurons_hidden, $num_output);

if ($ann) {
	fann_set_activation_function_hidden($ann, FANN_SIGMOID_SYMMETRIC);
	fann_set_activation_function_output($ann, FANN_SIGMOID_SYMMETRIC);

	$filename = dirname(__FILE__) . "input_coba_5.data";
	if (fann_train_on_file($ann, $filename, $max_epochs, $epochs_between_reports, $desired_error))
		print('currency trained.<br>' . PHP_EOL);

	if (fann_save($ann, dirname(__FILE__) . "input_coba_float.net"))
		print('input_coba_float.net saved.<br><a href="input.php">Test</a>' . PHP_EOL);

	fann_destroy($ann);
	echo "a";
}
?>