<?php

/**
 * Assert that the application is up.
 */
function assertIsUp() : mixed
{
	expect(app()->isDownForMaintenance())
		->toBeFalse('The application is expected to be up, but is not.');

	return test();
}

/**
 * Assert that the application is down for maintenance.
 */
function assertIsDown() : mixed
{
	expect(app()->isDownForMaintenance())
		->toBeTrue('The application is expected to be down, but is not.');

	return test();
}
