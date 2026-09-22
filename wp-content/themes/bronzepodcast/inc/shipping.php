<?php
/**
 * Cálculo dinâmico de portes de envio por escalões de peso (CTT Expresso).
 *
 * @package BronzePodcast
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Aplica os escalões de portes do Bronze Podcast com base no peso total do carrinho.
 *
 * @param array $rates   Taxas de envio calculadas pelo WooCommerce.
 * @param array $package Conteúdo e destino da encomenda.
 * @return array
 */
function bronzepodcast_calculate_weight_shipping( $rates, $package ) {
	$base_country        = function_exists( 'WC' ) && WC()->countries ? WC()->countries->get_base_country() : 'PT';
	$destination_country = isset( $package['destination']['country'] ) && ! empty( $package['destination']['country'] )
		? strtoupper( trim( $package['destination']['country'] ) )
		: $base_country;

	// Países europeus abrangidos historicamente.
	$european_countries = array(
		'AD', 'AL', 'AT', 'BE', 'CH', 'CZ', 'DE', 'DK', 'EE', 'ES',
		'FI', 'FR', 'GB', 'GI', 'GR', 'HU', 'IM', 'IS', 'IT', 'LI',
		'LV', 'MC', 'MT', 'NO', 'PL', 'RO', 'RU', 'SE', 'ST', 'UA',
		'VA', 'NL', 'IE', 'LU',
	);

	// Cálculo do peso total do carrinho convertido para quilogramas (kg).
	$total_weight = 0;
	if ( isset( $package['contents'] ) && is_array( $package['contents'] ) ) {
		foreach ( $package['contents'] as $values ) {
			if ( isset( $values['data'] ) && is_object( $values['data'] ) ) {
				$raw_weight = (float) $values['data']->get_weight();
				if ( $raw_weight <= 0 ) {
					// Se a peça ainda não tiver peso no catálogo, assumimos 150g como valor base de segurança.
					$item_weight = 0.15;
				} elseif ( function_exists( 'wc_get_weight' ) ) {
					$item_weight = (float) wc_get_weight( $raw_weight, 'kg' );
				} else {
					$unit = get_option( 'woocommerce_weight_unit', 'kg' );
					$item_weight = ( 'g' === $unit ) ? ( $raw_weight / 1000 ) : $raw_weight;
				}

				$quantity      = isset( $values['quantity'] ) ? absint( $values['quantity'] ) : 1;
				$total_weight += ( $item_weight * $quantity );
			}
		}
	}

	if ( $total_weight <= 0 ) {
		$total_weight = 0.2;
	}

	$cost  = 0;
	$label = '';

	if ( 'PT' === $destination_country ) {
		$label = __( 'CTT Expresso (Portugal)', 'bronzepodcast' );
		if ( $total_weight <= 1.0 ) {
			$cost = 3.99;
		} elseif ( $total_weight <= 5.0 ) {
			$cost = 14.90;
		} elseif ( $total_weight <= 15.0 ) {
			$cost = 19.90;
		} else {
			$cost = 24.90;
		}
	} elseif ( in_array( $destination_country, $european_countries, true ) ) {
		$label = __( 'Correio Registado Expresso (Europa)', 'bronzepodcast' );
		if ( $total_weight <= 1.0 ) {
			$cost = 7.99;
		} elseif ( $total_weight <= 5.0 ) {
			$cost = 15.99;
		} elseif ( $total_weight <= 15.0 ) {
			$cost = 24.90;
		} else {
			$cost = 34.90;
		}
	} else {
		// Outros destinos internacionais.
		$label = __( 'Envio Internacional Registado', 'bronzepodcast' );
		if ( $total_weight <= 1.0 ) {
			$cost = 12.90;
		} elseif ( $total_weight <= 5.0 ) {
			$cost = 24.90;
		} else {
			$cost = 39.90;
		}
	}

	try {
		$rate_id    = 'bronzepodcast_ctt_rate';
		$rate_label = sprintf( '%s (%s kg)', $label, number_format( $total_weight, 2, ',', '' ) );

		$new_rate = new WC_Shipping_Rate(
			$rate_id,
			$rate_label,
			$cost,
			array(),
			'bronzepodcast_shipping'
		);

		// Preservar métodos especiais como Portes Grátis ou Levantamento se existirem
		$output_rates = array();
		if ( is_array( $rates ) ) {
			foreach ( $rates as $key => $rate ) {
				$method_id = ( is_object( $rate ) && method_exists( $rate, 'get_method_id' ) ) ? $rate->get_method_id() : '';
				if ( in_array( $method_id, array( 'free_shipping', 'local_pickup' ), true ) || ( is_object( $rate ) && (float) $rate->get_cost() === 0.0 ) ) {
					$output_rates[ $key ] = $rate;
				}
			}
		}

		$output_rates[ $rate_id ] = $new_rate;

		return $output_rates;
	} catch ( Throwable $e ) {
		return $rates;
	}
}
add_filter( 'woocommerce_package_rates', 'bronzepodcast_calculate_weight_shipping', 100, 2 );
