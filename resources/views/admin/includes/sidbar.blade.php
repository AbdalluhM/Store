
				<!--begin::Aside-->
				<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
					<!--begin::Brand-->
					<div class="aside-logo flex-column-auto" id="kt_aside_logo">
						<!--begin::Logo-->
						<a href="{{route('home')}}">
							<img alt="Logo" src="{{asset('assets/media/logos/logo-1.svg')}}" class="h-15px logo" />
						</a>
						<!--end::Logo-->
						<!--begin::Aside toggler-->
						<div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
							<!--begin::Svg Icon | path: icons/duotone/Navigation/Angle-double-left.svg-->
							<span class="svg-icon svg-icon-1 rotate-180">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24" />
										<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
										<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.5" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
									</g>
								</svg>
							</span>
							<!--end::Svg Icon-->
						</div>
						<!--end::Aside toggler-->
					</div>
					<!--end::Brand-->
					<!--begin::Aside menu-->
					<div class="aside-menu flex-column-fluid">
						<!--begin::Aside Menu-->
						<div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
							<!--begin::Menu-->
							<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
								<div class="menu-item">
									<a class="menu-link active" href="{{route('home')}}">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotone/Design/PenAndRuller.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
													<path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">{{ trans('sidbar.Dashboard') }}</span>
									</a>
								</div>
								<div class="menu-item">
									<div class="menu-content pt-8 pb-2">
										<span class="menu-section text-muted text-uppercase fs-8 ls-1">Crafted</span>
									</div>
								</div>

								<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                        <span class="menu-link">
                                            <span class="menu-bullet">
                                                <i class="fas fa-layer-group"></i>
                                            </span>
                                            <span class="menu-title">{{__('sidbar.Categories')}}</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                                            <div class="menu-item">
                                                <a class="menu-link" href="{{route('categories.index')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{__('sidbar.Main-Categories')}}</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="{{route('index_sub_category')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{__('sidbar.Sup-Categories')}}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                        <span class="menu-link">
                                            <span class="menu-bullet">
                                                <i class="fas fa-cart-plus"></i>
                                            </span>
                                            <span class="menu-title">{{__('sidbar.products')}}</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                                            <div class="menu-item">
                                                <a class="menu-link" href="{{route('products.index')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{__('sidbar.All-PRODUCTS')}}</span>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                        <span class="menu-link">
                                            <span class="menu-bullet">
                                                <i class="fas fa-palette"></i>
                                            </span>
                                            <span class="menu-title">{{__('sidbar.colors')}}</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                                            <div class="menu-item">
                                                <a class="menu-link" href="{{route('colors.index')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{__('sidbar.All-Colors')}}</span>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                        <span class="menu-link">
                                            <span class="menu-bullet">
                                                <i class="fas fa-euro-sign"></i>
                                            </span>
                                            <span class="menu-title">{{__('sidbar.offers')}}</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                                            <div class="menu-item">
                                                <a class="menu-link" href="{{route('offers.index')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{__('sidbar.All-Offers')}}</span>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                        <span class="menu-link">
                                            <span class="menu-bullet">
                                                <i class="fab fa-buffer"></i>
                                            </span>
                                            <span class="menu-title">{{__('sidbar.sizes')}}</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                                            <div class="menu-item">
                                                <a class="menu-link" href="{{route('sizes.index')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{__('sidbar.All-Sizes')}}</span>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                        <span class="menu-link">
                                            <span class="menu-bullet">
                                                <i class="fas fa-audio-description"></i>
                                            </span>
                                            <span class="menu-title">{{__('sidbar.sliders')}}</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                                            <div class="menu-item">
                                                <a class="menu-link" href="{{route('sliders.index')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{__('sidbar.All-Sliders')}}</span>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <!--begin::Svg Icon | path: icons/duotone/Communication/Group.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                                            <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                                        </g>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-title">{{__('sidbar.orders')}}</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion">
                                            <div class="menu-item">
                                                <a class="menu-link" href="{{route('orders.index')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{__('sidbar.orders-list')}}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <!--begin::Svg Icon | path: icons/duotone/Communication/Group.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-title">{{__('sidbar.customers')}}</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion">
                                            <div class="menu-item">
                                                <a class="menu-link" href="{{route('customers.index')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{__('sidbar.customers-list')}}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
									{{-- <span class="menu-link">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotone/Code/Compiling.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
													<path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">{{__('sidbar.Pages')}}</span>
										<span class="menu-arrow"></span>
									</span> --}}

								</div>
								<div data-kt-menu-trigger="click" class="menu-item menu-accordion mb-1">
									<span class="menu-link">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotone/General/Shield-protected.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3" />
														<path d="M14.5,11 C15.0522847,11 15.5,11.4477153 15.5,12 L15.5,15 C15.5,15.5522847 15.0522847,16 14.5,16 L9.5,16 C8.94771525,16 8.5,15.5522847 8.5,15 L8.5,12 C8.5,11.4477153 8.94771525,11 9.5,11 L9.5,10.5 C9.5,9.11928813 10.6192881,8 12,8 C13.3807119,8 14.5,9.11928813 14.5,10.5 L14.5,11 Z M12,9 C11.1715729,9 10.5,9.67157288 10.5,10.5 L10.5,11 L13.5,11 L13.5,10.5 C13.5,9.67157288 12.8284271,9 12,9 Z" fill="#000000" />
													</g>
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">User Management</span>
										<span class="menu-arrow"></span>
									</span>
									<div class="menu-sub menu-sub-accordion">
										<div data-kt-menu-trigger="click" class="menu-item menu-accordion mb-1">
											<span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Users</span>
												<span class="menu-arrow"></span>
											</span>
											<div class="menu-sub menu-sub-accordion">
												<div class="menu-item">
													<a class="menu-link" href="{{route('users.index')}}">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Users List</span>
													</a>
												</div>
												<div class="menu-item">
													<a class="menu-link" href="#">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">View User</span>
													</a>
												</div>
											</div>
										</div>
										<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
											<span class="menu-link">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Roles</span>
												<span class="menu-arrow"></span>
											</span>
											<div class="menu-sub menu-sub-accordion">
												<div class="menu-item">
													<a class="menu-link" href="{{route('roles.index')}}">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Roles List</span>
													</a>
												</div>
												<div class="menu-item">
													<a class="menu-link" href="#">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">View Role</span>
													</a>
												</div>
											</div>
										</div>
										<div class="menu-item">
											<a class="menu-link" href="{{route('permission.index')}}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Permissions</span>
											</a>
										</div>
									</div>
								</div>
							</div>
							<!--end::Menu-->
						</div>
					</div>
					<!--end::Aside menu-->
					<!--begin::Footer-->
					<div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
						<a href="#" class="btn btn-custom btn-primary w-100" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="Check out over 200 in-house components, plugins and ready for use solutions">
							<span class="btn-label">End &amp; Dashboard</span>
							<!--begin::Svg Icon | path: icons/duotone/General/Clipboard.svg-->
							<span class="svg-icon btn-icon svg-icon-2">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24" />
										<path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3" />
										<path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000" />
										<rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1" />
										<rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1" />
									</g>
								</svg>
							</span>
							<!--end::Svg Icon-->
						</a>
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Aside-->
