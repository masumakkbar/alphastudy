<?php
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;


/**
 * Elementor Table Widget.
 *
 * @since 1.0.0
 */
class Themephi_Pro_Table_Elementor_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'TP-Table';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'TP Table', 'tp-elements' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'flaticon-table-for-data';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'tpaddon_category' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_table_header',
			[
				'label' => esc_html__( 'Table Header', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'table_header',
			[
				'label' => esc_html__( 'Table Header Cell', 'tp-elements' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'text' => esc_html__( 'Table Header', 'tp-elements' ),
					],
					[
						'text' => esc_html__( 'Table Header', 'tp-elements' ),
					]
				],
				'fields' => [
					[
						'name' => 'text',
						'label' => esc_html__( 'Text', 'tp-elements' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'placeholder' => esc_html__( 'Table Header', 'tp-elements' ),
						'default' => esc_html__( 'Table Header', 'tp-elements' ),
						'dynamic' => [
		                    'active' => true,
		                ]
					],
					[
						'name'	=> 'advance',
						'label' => esc_html__( 'Advance Settings', 'tp-elements' ),
						'type' => Controls_Manager::SWITCHER,
						'label_off' => esc_html__( 'No', 'tp-elements' ),
						'label_on' => esc_html__( 'Yes', 'tp-elements' ),
					],
					[
						'name'	=> 'colspan',
						'label' => esc_html__( 'colSpan', 'tp-elements' ),
						'type' => Controls_Manager::SWITCHER,
						'condition' => [
							'advance' => 'yes',
						],
						'label_off' => esc_html__( 'No', 'tp-elements' ),
						'label_on' => esc_html__( 'Yes', 'tp-elements' ),
					],
					[
						'name'	=> 'colspannumber',
						'label' => esc_html__( 'colSpan Number', 'tp-elements' ),
						'type' => Controls_Manager::TEXT,
						'condition' => [
							'advance' => 'yes',
							'colspan' => 'yes',
						],
						'placeholder' => esc_html__( '1', 'tp-elements' ),
						'default' => esc_html__( '1', 'tp-elements' ),
					],
					[
						'name'	=> 'customwidth',
						'label' => esc_html__( 'Custom Width', 'tp-elements' ),
						'type' => Controls_Manager::SWITCHER,
						'condition' => [
							'advance' => 'yes',
						],
						'label_off' => esc_html__( 'No', 'tp-elements' ),
						'label_on' => esc_html__( 'Yes', 'tp-elements' ),
					],
					[
						'name'	=> 'width',
						'label' => esc_html__( 'Width', 'tp-elements' ),
						'type' => Controls_Manager::SLIDER,
						'condition' => [
							'advance' => 'yes',
							'customwidth' => 'yes',
						],
						'range' => [
							'%' => [
								'min' => 0,
								'max' => 100,
							],
							'px' => [
								'min' => 1,
								'max' => 1000,
							],
						],
						'default' => [
							'size' => 30,
							'unit' => '%',
						],
						'size_units' => [ '%', 'px' ],
						'selectors' => [ '{{WRAPPER}} table.rselements-table {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
						]
					],
					[
						'name' => 'align', 
						'label' => esc_html__( 'Alignment', 'tp-elements' ),
						'type' => Controls_Manager::CHOOSE,
						'condition' => [
							'advance' => 'yes',
						],
						'options' => [
							'left' => [
								'title' => esc_html__( 'Left', 'tp-elements' ),
								'icon' => 'eicon-text-align-left',
							],
							'center' => [
								'title' => esc_html__( 'Center', 'tp-elements' ),
								'icon' => 'eicon-text-align-center',
							],
							'right' => [
								'title' => esc_html__( 'Right', 'tp-elements' ),
								'icon' => 'eicon-text-align-right',
							],
							'justify' => [
								'title' => esc_html__( 'Justified', 'tp-elements' ),
								'icon' => 'eicon-text-align-justify',
							],
						],
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} table.rselements-table {{CURRENT_ITEM}}' => 'text-align: {{VALUE}};',
						]
					],
					[
						'name'	=> 'decoration',
						'label' => esc_html__( 'Decoration', 'tp-elements' ),
						'type' => Controls_Manager::SELECT,
						'condition' => [
							'advance' => 'yes',
						],
						'options' => [
							''  => esc_html__( 'Default', 'tp-elements' ),
							'underline' => esc_html__( 'Underline', 'tp-elements' ),
							'overline' => esc_html__( 'Overline', 'tp-elements' ),
							'line-through' => esc_html__( 'Line Through', 'tp-elements' ),
							'none' => esc_html__( 'None', 'tp-elements' ),
						],
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} table.rselements-table {{CURRENT_ITEM}}' => 'text-decoration: {{VALUE}};',
						],
					]
				],
				'title_field' => '{{{ text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_table_body',
			[
				'label' => esc_html__( 'Table Body', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		
		$repeater->add_control(
			'row', [
				'label' => esc_html__( 'New Row', 'tp-elements' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'tp-elements' ),
				'label_on' => esc_html__( 'Yes', 'tp-elements' ),
			]
		);

		$repeater->add_control(
			'text', [
				'label' => esc_html__( 'Text', 'tp-elements' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'placeholder' => esc_html__( 'Table Data', 'tp-elements' ),
				'default' => esc_html__( 'Table Data', 'tp-elements' ),
				'dynamic' => [
		            'active' => true,
		        ]
			]
		);

		
		$repeater->add_control(
			'advance', [
				'label' => esc_html__( 'Advance Settings', 'tp-elements' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'tp-elements' ),
				'label_on' => esc_html__( 'Yes', 'tp-elements' ),
			]
		);

		$repeater->add_control(
			'colspan', [
				'label' => esc_html__( 'colSpan', 'tp-elements' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'advance' => 'yes',
				],
				'label_off' => esc_html__( 'No', 'tp-elements' ),
				'label_on' => esc_html__( 'Yes', 'tp-elements' ),
			]
		);

		$repeater->add_control(
			'colspannumber', [
				'label' => esc_html__( 'colSpan Number', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'advance' => 'yes',
					'colspan' => 'yes',
				],
				'placeholder' => esc_html__( '1', 'tp-elements' ),
				'default' => esc_html__( '1', 'tp-elements' ),
			]
		);

		$repeater->add_control(
			'rowspan', [
				'label' => esc_html__( 'rowSpan', 'tp-elements' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'advance' => 'yes',
				],
				'label_off' => esc_html__( 'No', 'tp-elements' ),
				'label_on' => esc_html__( 'Yes', 'tp-elements' ),
			]
		);

		$repeater->add_control(
			'rowspannumber', [
				'label' => esc_html__( 'rowSpan Number', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'advance' => 'yes',
					'rowspan' => 'yes',
				],
				'placeholder' => esc_html__( '1', 'tp-elements' ),
				'default' => esc_html__( '1', 'tp-elements' ),
			]
		);

		$repeater->add_control(
			'align', [
				'label' => esc_html__( 'Alignment', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'condition' => [
					'advance' => 'yes',
				],
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'tp-elements' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'tp-elements' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'tp-elements' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'tp-elements' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} table.rselements-table {{CURRENT_ITEM}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'decoration',
			[
				'label' => esc_html__( 'Decoration', 'tp-elements' ),
				'type' => Controls_Manager::SELECT,
				'condition' => [
					'advance' => 'yes',
				],
				'options' => [
					''  => esc_html__( 'Default', 'tp-elements' ),
					'underline' => esc_html__( 'Underline', 'tp-elements' ),
					'overline' => esc_html__( 'Overline', 'tp-elements' ),
					'line-through' => esc_html__( 'Line Through', 'tp-elements' ),
					'none' => esc_html__( 'None', 'tp-elements' ),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} table.rselements-table {{CURRENT_ITEM}}' => 'text-decoration: {{VALUE}};',
				],
			]
		);	


		$this->add_control(
			'table_body',
			[
				'label' => esc_html__( 'Table Body Cell', 'tp-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => esc_html__( 'Table Data', 'tp-elements' ),
					],
					[
						'text' => esc_html__( 'Table Data', 'tp-elements' ),
					],
				],
				'title_field' => '{{{ text }}}',
			]
		);



		$this->end_controls_section();

		 $this->start_controls_section(
            '_section_datatables',
            [
                'label' => esc_html__( 'DataTable', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );      

      
        $this->add_control(
            'show_search',
            [
                'label' => esc_html__( 'Enable Search', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,               
                'label_on' => esc_html__( 'Show', 'tp-elements' ),
                'label_off' => esc_html__( 'Hide', 'tp-elements' ),
                'return_value' => 'yes',
                'default' => 'no',               
            ]
        );

        $this->add_control(
            'show_pagination',
            [
				'label'        => esc_html__( 'Enable Pagination', 'tp-elements' ),
				'type'         => Controls_Manager::SWITCHER,               
				'label_on'     => esc_html__( 'Show', 'tp-elements' ),
				'label_off'    => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default'      => 'no',               
            ]
        );

        $this->add_control(
            'enable_ordering',
            [
				'label'        => esc_html__( 'Enable Ordering', 'tp-elements' ),
				'type'         => Controls_Manager::SWITCHER,               
				'label_on'     => esc_html__( 'Show', 'tp-elements' ),
				'label_off'    => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default'      => 'no',                
            ]
        );

        $this->add_control(
            'show_tableinfo',
            [
				'label'        => esc_html__( 'Show Table Info', 'tp-elements' ),
				'type'         => Controls_Manager::SWITCHER,               
				'label_on'     => esc_html__( 'Show', 'tp-elements' ),
				'label_off'    => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default'      => 'no',              
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'General Style', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'table_padding',
			[
				'label' => esc_html__( 'Inner Cell Padding', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} table.rselements-table td,{{WRAPPER}} table.rselements-table th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'table_border',
				'label' => esc_html__( 'Border', 'tp-elements' ),
				'selector' => '{{WRAPPER}} table.rselements-table td,{{WRAPPER}} table.rselements-table th',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'table_header_style',
			[
				'label' => esc_html__( 'Table Header Style', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'header_align',
			[
				'label' => esc_html__( 'Alignment', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'tp-elements' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'tp-elements' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'tp-elements' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'tp-elements' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-header' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'header_text_color',
			[
				'label' => esc_html__( 'Text Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-header' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'header_typography',
				'selector' => '{{WRAPPER}} table.rselements-table .rselements-table-header',
				
			]
		);

		$this->add_control(
			'header_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-header' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'table_body_style',
			[
				'label' => esc_html__( 'Table Body Style', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'body_align',
			[
				'label' => esc_html__( 'Alignment', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'tp-elements' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'tp-elements' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'tp-elements' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'tp-elements' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'body_text_color',
			[
				'label' => esc_html__( 'Text Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'body_typography',
				'selector' => '{{WRAPPER}} table.rselements-table .rselements-table-body',
				
			]
		);

		$this->add_control(
			'body_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'striped_bg', 
			[
				'label' => esc_html__( 'Striped Background', 'tp-elements' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'tp-elements' ),
				'label_on' => esc_html__( 'Yes', 'tp-elements' ),
			]
		);
		$this->add_control(
			'striped_bg_color', 
			[
				'label' => esc_html__( 'Secondary Background Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'striped_bg' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body tr:nth-of-type(2n)' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$unique = rand(10,6554120);

		$search     = ($settings['show_search'] == 'yes') ? "true" : "false";
		$order      = ($settings['enable_ordering'] == 'yes') ? "true" : "false";
		$tableinfo  = ($settings['show_tableinfo'] == 'yes') ? "true" : "false";
		$pagination = ($settings['show_pagination'] == 'yes') ? "true" : "false";		
		?>
		<table class="rselements-table" id="datatable-<?php echo esc_attr($unique);?>">
			<thead  class="rselements-table-header">
				<tr>
					<?php
					foreach ($settings['table_header'] as $index => $headeritem) {
						$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'table_header', $index );
						$this->add_inline_editing_attributes( $repeater_setting_key );

						$colspan = ($headeritem['colspan'] == 'yes' && $headeritem['advance'] == 'yes') ? 'colSpan="'.$headeritem['colspannumber'].'"' : '';

						echo '<th class="elementor-inline-editing elementor-repeater-headeritem-'.$headeritem['_id'].'"  '.$colspan.' '.$this->get_render_attribute_string( $repeater_setting_key ).'>'.$headeritem['text'].'</th>';
					}
					?>
				</tr>
			</thead>
			<tbody class="rselements-table-body">
				<tr>
					<?php
					foreach ($settings['table_body'] as $index => $item) {
						$table_body_key = $this->get_repeater_setting_key( 'text', 'table_body', $index );

						$this->add_render_attribute( $table_body_key, 'class', 'elementor-repeater-item-'.$item['_id'] );
						$this->add_inline_editing_attributes( $table_body_key );

						if($item['row'] == 'yes'){
							echo '</tr><tr>';
						}

						$colspan = ($item['colspan'] == 'yes' && $item['advance'] == 'yes') ? 'colSpan="'.$item['colspannumber'].'"' : '';

						$rowspan = ($item['rowspan'] == 'yes' & $item['advance'] == 'yes') ? 'rowSpan="'.$item['rowspannumber'].'"' : '';

						echo '<td '.$colspan.' '.$rowspan.' '.$this->get_render_attribute_string( $table_body_key ).' >'.$item['text'].'</td>';
					}
					?>
				</tr>
			</tbody>
		</table>

		<script type="text/javascript">
			jQuery(document).ready(function () {
				jQuery('#datatable-<?php echo esc_attr($unique);?>').DataTable({
					"searching": <?php echo esc_html($search);?>,
					"paging":   <?php echo esc_html($pagination);?>,
			        "ordering": <?php echo esc_html($order);?>,
			        "info":     <?php echo esc_html($tableinfo);?>,			      
				});
				jQuery('.dataTables_length').addClass('rsdatatable-select');

			});


		</script>
		
		<?php

	}
	protected function _content_template() {
		?>
		<table class="rselements-table">
			<thead class="rselements-table-header">
				<tr>
					<#
					if ( settings.table_header ) {
						_.each( settings.table_header, function( item, index ) {
							var iconTextKey = view.getRepeaterSettingKey( 'text', 'table_header', index );

							if( 'yes' === item.colspan && 'yes' === item.advance){
								colSpan = 'colSpan="'+item.colspannumber+'"';
							}else{
								colSpan = '';
							}
							
							view.addRenderAttribute( iconTextKey, 'class', 'elementor-repeater-item-'+item._id );
							view.addInlineEditingAttributes( iconTextKey );
							#>
							<th {{{colSpan}}} {{{ view.getRenderAttributeString( iconTextKey ) }}}>{{{ item.text }}}</th>
						<#
						} );
					} #>
				</tr>
			</thead>
			<tbody class="rselements-table-body">
				<tr>
					<#
					if ( settings.table_body ) {
						_.each( settings.table_body, function( item, index ) {
							if( 'yes' === item.row){
								newRow = '</tr><tr>';
							}else{
								newRow = '';
							}

							if( 'yes' === item.colspan && 'yes' === item.advance){
								colSpan = 'colSpan="'+item.colspannumber+'"';
							}else{
								colSpan = '';
							}

							if( 'yes' === item.rowspan && 'yes' === item.advance){
								rowSpan = 'rowSpan="'+item.rowspannumber+'"';
							}else{
								rowSpan = '';
							}

							var tdTextKey = view.getRepeaterSettingKey( 'text', 'table_body', index );
							
							view.addRenderAttribute( tdTextKey, 'class', 'elementor-repeater-item-'+item._id );
							view.addInlineEditingAttributes( tdTextKey );

							#>
							{{{newRow}}}
							<td {{{rowSpan}}} {{{colSpan}}} {{{ view.getRenderAttributeString( tdTextKey ) }}}>{{{ item.text }}}</td>
						<#
						} );
					} #>
				</tr>
			</tbody>
		</table>


		<?php
	}
}
