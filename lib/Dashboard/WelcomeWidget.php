<?php

/**
 * SPDX-FileCopyrightText: 2020 Nextcloud GmbH and Nextcloud contributors
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

namespace OCA\Welcome\Dashboard;

use OCA\Welcome\AppInfo\Application;
use OCP\Dashboard\IWidget;
use OCP\IConfig;
use OCP\IL10N;
use OCP\IURLGenerator;
use OCP\Util;

class WelcomeWidget implements IWidget {

	public function __construct(
		private IL10N $l10n,
		private IURLGenerator $url,
		private IConfig $config,
	) {
	}

	/**
	 * @inheritDoc
	 */
	public function getId(): string {
		return 'welcome';
	}

	/**
	 * @inheritDoc
	 */
	public function getTitle(): string {
		$widgetTitle = $this->config->getAppValue(Application::APP_ID, 'widgetTitle', $this->l10n->t('Welcome'));
		return $widgetTitle ?: $this->l10n->t('Welcome');
	}

	/**
	 * @inheritDoc
	 */
	public function getOrder(): int {
		return 10;
	}

	/**
	 * @inheritDoc
	 */
	public function getIconClass(): string {
		return 'icon-welcome';
	}

	/**
	 * @inheritDoc
	 */
	public function getUrl(): ?string {
		return $this->url->linkToRoute('settings.AdminSettings.index', ['section' => 'theming']);
	}

	/**
	 * @inheritDoc
	 */
	public function load(): void {
		Util::addScript(Application::APP_ID, Application::APP_ID . '-dashboard');
		Util::addStyle(Application::APP_ID, 'dashboard');
	}
}
