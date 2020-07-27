import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ChargedFeesComponent } from './charged-fees.component';

describe('ChargedFeesComponent', () => {
  let component: ChargedFeesComponent;
  let fixture: ComponentFixture<ChargedFeesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ChargedFeesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ChargedFeesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
