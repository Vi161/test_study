import AppService from "./modules/app.service";
import {config} from './modules/config';
import './modules/header.components';
import './custom.scss';

console.log('config key: ', config.key);

const service = new AppService('Hello World!');
service.log();