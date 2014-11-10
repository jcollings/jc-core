<?php

class JCC_GridColumns_Shortcode{

	protected $grid = false;
	protected $col = false;
	protected $prefix = '';
	protected $col_wrapper = '';
	protected $grid_wrapper = '';

	public function __construct(){

		$this->prefix = apply_filters( 'jcc/grid/shortcode_prefix', '' );
		$this->col_wrapper = apply_filters( 'jcc/grid/column_wrapper', 'div' );
		$this->grid_wrapper = apply_filters( 'jcc/grid/grid_wrapper', 'div' );

		add_shortcode( $this->prefix.'grid', array( $this, 'shortcode_grid' ) );
		add_shortcode( $this->prefix.'col', array( $this, 'shortcode_col' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	public function enqueue_styles(){
		wp_enqueue_style( 'jcc_grid_css', get_template_directory_uri() . '/jc-core/shortcodes/assets/grid.css');
	}

	public function enqueue_scripts(){

	}

	
	public function shortcode_col($atts, $content = ''){

		extract( shortcode_atts( array(
			'span' => 1,
	    ), $atts ) );

	    $this->col++;

	    $classes = array('jcc_col', 'jcc_col_'.$span);

		if( ( $this->col % $this->grid ) == 0 ){
			$classes[] = 'jcc_col_last';
		}elseif( ( $this->col % $this->grid ) == 1 ){
			$classes[] = 'jcc_col_first';
		}

		$classes[] = 'jcc_loop_'. $this->col;

	    $output = '<'.$this->col_wrapper.' class="'. implode( ' ', $classes ) .'">';
	    $output .= '<div class="jcc_col_wrapper">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		$output .= '</'.$this->col_wrapper.'>';

	    return $output;
	}

	public function shortcode_grid($atts, $content = ''){

		extract( shortcode_atts( array(
			'cols' => 1,
	    ), $atts ) );

	    $this->grid =  intval($cols);
	    $this->col = 0;

	    $output = '<'.$this->grid_wrapper.' class="jcc_grid_' . $this->grid.'">';
		$output .= do_shortcode($content);
		$output .= '</'.$this->grid_wrapper.'>';

		return $output;
	}


}

new JCC_GridColumns_Shortcode();