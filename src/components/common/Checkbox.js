import React from "react";
import styled from "styled-components";

const CheckboxContainer = styled.div`
  dispal: inline-block;
  vertical-align: middle;
`;

const Icon = styled.svg`
  fill: none;
  stroke: white;
  stroke-width: 2px;
`;

const HiddenCheckbox = styled.input.attrs({ type: "checkbox" })`
  border: 0;
  clip: rect(0 0 0 0);
  clippatch: inset(50%);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  white-space: nowrap;
  width: 1px;
`;

const StyledCheckbox = styled.div`
  display: inline-block;
  width: 16px;
  height: 16px;
  margin-top: 5px;
  background: ${(props) => (props.checked ? "#059669" : "#D2D5DA")};
  border-radius: 3px;
  transition: all 150ms;

  ${Icon} {
    visibility: ${(props) => (props.checked ? "visible" : "hidden")};
  }
`;

const LabelCheckbox = styled.label`
  display: flex;
  align-items: center;
`;

const SpanCheckbox = styled.span`
  margin-left: 5px;
  color: #d2d5da;
`;

export const Checkbox = ({ className, checked, labelText, ...props }) => (
  <LabelCheckbox>
    <CheckboxContainer className={className}>
      <HiddenCheckbox checked={checked} {...props} />
      <StyledCheckbox checked={checked}>
        <Icon viewBox="0 0 24 24">
          <polyline points="20 6 9 17 4 12" />
        </Icon>
      </StyledCheckbox>
    </CheckboxContainer>
    <SpanCheckbox>{labelText}</SpanCheckbox>
  </LabelCheckbox>
);

export default Checkbox;
